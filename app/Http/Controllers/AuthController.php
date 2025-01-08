<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'gender' => 'required|in:Male,Female',
            'current_job' => 'required|string|max:255',
            'field_of_work' => 'required|array|min:3',
            'linkedin' => 'required|url|regex:/https:\/\/www\.linkedin\.com\/in\/.+/',
            'mobile' => 'required|digits_between:10,13',
        ]);

        // Convert the array to a comma-separated string
        $fieldOfWork = implode(',', $validated['field_of_work']);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'gender' => $validated['gender'],
            'field_of_work' => $fieldOfWork,
            'linkedin_username' => $validated['linkedin'],
            'phone_number' => $validated['mobile'],
            'current_job' => $validated['current_job'],
        ]);

        $registrationPrice = rand(100000, 125000);
        session(['registration_price' => $registrationPrice, 'user_id' => $user->id]);

        return redirect()->route('payment')->with('success', 'User registered successfully!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}

