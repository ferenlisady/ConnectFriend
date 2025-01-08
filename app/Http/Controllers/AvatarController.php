<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\User;
use App\Models\AvatarTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function index()
    {
        $avatars = Avatar::paginate(6);
        return view('listAvatar', compact('avatars'));
    }

    public function purchase(Request $request, $id)
    {
        $avatar = Avatar::findOrFail($id);
        $user = auth()->user();

        if ($user->coin < $avatar->price) {
            return back()->with('error', __('avatar.not_enough_coins'));
        }

        $user->coin -= $avatar->price;
        $user->save();

        AvatarTransaction::create([
            'user_id' => $user->id,
            'avatar_id' => $avatar->id,
        ]);

        return back()->with('success', __('avatar.avatar_purchased'));
    }

    public function myAvatars()
    {
        $user = auth()->user();
        $userId = auth()->user()->id;
        $friends = DB::table('friends')
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->join('users', function ($join) use ($userId) {
                $join->on('friends.sender_id', '=', 'users.id')
                    ->where('friends.receiver_id', '=', $userId)
                    ->orOn('friends.receiver_id', '=', 'users.id')
                    ->where('friends.sender_id', '=', $userId);
            })
            ->select('users.id', 'users.name', 'users.profile_picture')
            ->get();
        $avatars = $user->avatars()->paginate(6);

        return view('myAvatar', compact('avatars', 'friends'));
    }

    public function setProfilePicture(Request $request, $avatarId)
    {
        $user = auth()->user();
        $avatar = Avatar::findOrFail($avatarId);

        $user->profile_picture = $avatar->image;
        $user->save();

        return back()->with('success', __('avatar.profile_picture_updated'));
    }

    public function sendAvatar(Request $request, $avatarId, $receiverId)
    {
        $receiverId = $request->input('receiver_id');
        $sender = auth()->user();
        $receiver = User::findOrFail($receiverId);
        $avatar = Avatar::findOrFail($avatarId);

        DB::table('user_avatar_shares')->insert([
            'avatar_id' => $avatar->id,
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', __('avatar.avatar_sent'));
    }

    public function receivedAvatars()
    {
        $user = auth()->user();
        $avatars = DB::table('avatars')
            ->join('user_avatar_shares', 'avatars.id', '=', 'user_avatar_shares.avatar_id')
            ->join('users as senders', 'user_avatar_shares.sender_id', '=', 'senders.id')
            ->where('user_avatar_shares.receiver_id', '=', $user->id)
            ->select('avatars.id', 'avatars.name', 'avatars.image', 'avatars.price', 'senders.name as sender_name')
            ->paginate(6);

        return view('receivedAvatar', compact('avatars'));
    }

    public function saveAvatar($avatarId)
    {
        $user = auth()->user();
        $avatar = Avatar::findOrFail($avatarId);

        $receivedAvatar = DB::table('user_avatar_shares')
            ->where('receiver_id', $user->id)
            ->where('avatar_id', $avatar->id)
            ->first();

        $user->receivedAvatars()->detach($avatar->id);
        $user->avatars()->attach($avatar->id);

        return back()->with('success', __('avatar.avatar_saved'));
    }
}
