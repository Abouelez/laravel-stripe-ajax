<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    function index()
    {
        return view('payment.checkout');
    }

    function checkout(Request $request)
    {
        Stripe::setApiKey(config('stripe.sk'));
        try {
            $charge = Charge::create([
                'amount' => 5000,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment Test'
            ]);

            //store in db process

            return redirect()->route('success');
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
        $session = Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'use',
                        'product_data' => [
                            'name' => 'product'
                        ],
                        'unit_amount' => 500 //in cents
                    ],
                    'quantity' => 1
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout')
        ]);

        return redirect()->away($session->url);
    }
    function success()
    {
        return view('payment.success');
    }

    // function processPayment(Request $request)
    // {

    //     Stripe::setApiKey(env('STRIPE_SECRET')); // Secret key

    //     try {
    //         $paymentIntent = PaymentIntent::create([
    //             'amount' => 5000, // Price in cents
    //             'currency' => 'usd',
    //             'payment_method' => $request->payment_method_id,
    //             'confirmation_method' => 'manual',
    //             'confirm' => true,
    //         ]);

    //         if ($paymentIntent->status == 'succeeded') {
    //             // Payment succeeded, store order details

    //             return redirect()->route('payment.success')->with('message', 'Payment Successful!');
    //         } else {
    //             return back()->with('error', 'Payment failed. Please try again.');
    //         }
    //     } catch (\Exception $e) {
    //         return back()->with('error', $e->getMessage());
    //     }
    // }
    // function success()
    // {
    //     return view('payment.success');
    // }
}
