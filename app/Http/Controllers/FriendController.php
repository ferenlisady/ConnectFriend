<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function addFriend($receiver_id)
    {
        $authUser = Auth::user();

        $user = User::findOrFail($receiver_id);

        // Check if a friendship already exists
        $existingFriendship = Friend::where(function ($query) use ($authUser, $user) {
            $query->where('sender_id', $authUser->id)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($authUser, $user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $authUser->id);
        })->first();

        if ($existingFriendship) {
            return back()->with('error', __('friend.already_friends'));
        }

        Friend::create([
            'sender_id' => $authUser->id,
            'receiver_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('success', __('friend.friend_request_sent'));
    }

    public function accept($senderId)
    {
        $authUser = Auth::user();

        Friend::where('sender_id', $senderId)
            ->where('receiver_id', $authUser->id)
            ->where('status', 'pending')
            ->update([
                'status' => 'Accepted',
            ]);

        return back()->with('success', __('friend.friend_request_accepted'));
    }

    public function decline($senderId)
    {
        $authUser = Auth::user();

        Friend::where('sender_id', $senderId)
            ->where('receiver_id', $authUser->id)
            ->where('status', 'pending')
            ->delete();

        return back()->with('success', __('friend.friend_request_declined'));
    }
}
