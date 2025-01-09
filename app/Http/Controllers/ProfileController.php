<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Friend;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();

        $friends = Friend::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('status', 'accepted');
        })->orWhere(function ($query) use ($user) {
            $query->where('receiver_id', $user->id)
                ->where('status', 'accepted');
        })->get();

        $pendingRequests = Friend::where('receiver_id', $user->id)
            ->where('status', 'pending')
            ->get();

        return view('profile', compact('user', 'friends', 'pendingRequests'));
    }

    public function updateVisibility(Request $request)
    {
        $authUser = Auth::user();

        if ($authUser->visibility && $authUser->coin >= 50) {

            $authUser->coin -= 50;
            $authUser->visibility = false;

            $bearImages = ['assets/bear1.png', 'assets/bear2.png', 'assets/bear3.png'];
            $authUser->profile_picture = $bearImages[array_rand($bearImages)];

            $authUser->save();

            return back()->with('success', __('profile.invisibleSuccess'));
        } else if (!$authUser->visibility && $authUser->coin >= 5) {
            $authUser->coin -= 5;
            $authUser->visibility = true;
            $authUser->profile_picture = 'assets/default.png';
            $authUser->save();

            return back()->with('success', __('profile.visibleSuccess'));
        }

        return back()->with('error', ' __(profile.coinNotEnough)');
    }
}
