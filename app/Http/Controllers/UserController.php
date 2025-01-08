<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all users except the authenticated user
        $query = User::where('id', '!=', auth()->id())
            ->select(['id', 'name', 'current_job', 'field_of_work', 'profile_picture', 'visibility']);

        // Apply search by job
        if ($request->has('job') && $request->job != '') {
            $query->where('current_job', 'like', '%' . $request->job . '%');
        }

        // Apply gender filter 
        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        $users = $query->paginate(6);

        return view('home', compact('users'));
    }

    public function topUpCoin()
    {
        User::findOrFail(Auth::user()->id)
            ->update([
                'coin' => Auth::user()->coin + 100
            ]);

        return redirect()->back();
    }
}
