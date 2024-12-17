<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{

    function processPayment(Request $request)
    {

        Stripe::setApiKey(env('STRIPE_SECRET')); // Secret key

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => 5000, // Price in cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirmation_method' => 'manual',
                'confirm' => true,
            ]);

            if ($paymentIntent->status == 'succeeded') {
                // Payment succeeded, store order details

                return redirect()->route('payment.success')->with('message', 'Payment Successful!');
            } else {
                return back()->with('error', 'Payment failed. Please try again.');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    function success()
    {
        return view('payment.success');
    }
}
