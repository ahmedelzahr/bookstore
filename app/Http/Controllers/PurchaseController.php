<?php

namespace App\Http\Controllers;

use App\Mail\PaymentEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PurchaseController extends Controller
{
    public function creditCheckout()
    {

        $user = auth()->user(); 
        $booksOnCart = $user->booksOnCart;

        $stripeCustomer = $user->createOrGetStripeCustomer();
        $totalPrice = $user->booksOnCartPrice();
        $amount = $totalPrice * 100;
        $payment = auth()->user()->pay($amount);
        foreach ($booksOnCart as $book) {
            $user->booksOnCart()->updateExistingPivot($book->id, [
                'stripe_payment_intent_id' => $payment->id,
            ]);
        }

        return view('credit.checkout', [
            'clientSecret' => $payment->client_secret,
            'amount' => $totalPrice,

        ]);

    }

    public function completePayment(Request $request)
    {
        $user = auth()->user();
        $booksOnCart = $user->booksOnCart()->where('stripe_payment_intent_id', $request->payment_intent)->get();
        $paymentIntent = $user->stripe()->paymentIntents->retrieve($request->payment_intent);

        if ($paymentIntent->customer === $user->stripe_id &&
        $paymentIntent->status === 'succeeded') {
            foreach ($booksOnCart as $book) {
                $user->booksOnCart()->updateExistingPivot($book->id, [
                    'bought' => 1,
                ]);
                $user->booksOnCart()->updateExistingPivot($book->id, [
                    'created_at' => now(),
                ]);
            }
        }
        Mail::to($user)->send(new PaymentEmail( $booksOnCart,$user->booksOnCartPrice()));
        return redirect('/dashboard');

    }
}
