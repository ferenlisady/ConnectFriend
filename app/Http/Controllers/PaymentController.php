<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PaymentController extends Controller
{
    public function showPaymentPage()
    {
        // Check if the registration price is set in the session
        if (!session()->has('registration_price')) {
            return redirect()->route('register')->with('error', 'Please complete registration first.');
        }

        return view('auth.payment');
    }

    public function processPayment(Request $request)
    {
        // Retrieve the registration price from the session
        $registrationPrice = session('registration_price');

        // Validate the payment amount
        $validated = $request->validate([
            'payment' => 'required|numeric|min:1',
        ]);

        $payment = $validated['payment'];

        if ($payment < $registrationPrice) {
            // Underpaid
            $underpaid = $registrationPrice - $payment;
            return back()->with('payment_error', "You are still underpaid Rp " . number_format($underpaid, 0, ',', '.'));
        } else if ($payment > $registrationPrice) {
            // Overpaid
            $overpaid = $payment - $registrationPrice;
            session(['overpaid_amount' => $overpaid]);
            return view('auth.overpaid', compact('overpaid'));
        } else if ($payment == $registrationPrice) {
            $userId = session('user_id');
            $user = User::find($userId);

            if ($user) {
                $user->coin += 100;
                $user->save();

                session()->forget('registration_price');
                session()->forget('user_id');

                // Redirect to login page
                return redirect()->route('login')->with('success', 'Payment successful! Please log in.');
            }
        }
    }

    public function handleOverpayment(Request $request)
    {
        $userId = session('user_id');
        $user = User::find($userId);
        $overpaid = session('overpaid_amount');

        if (!$overpaid) {
            return redirect()->route('payment')->with('error', 'No overpayment detected. Please try again.');
        }

        if ($request->balance_option == 'yes') {
            $user->coin += 100 + $overpaid;
            $user->save();

            session()->forget('overpaid_amount');

            return redirect()->route('login')->with('success', 'Overpayment added to your wallet.');
        } else {
            return redirect()->route('payment')->with('error', 'Please enter the correct payment amount.');
        }
    }
}