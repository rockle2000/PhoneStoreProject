<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class StripeController extends Controller
{

    public function index(){

        \Stripe\Stripe::setApiKey('sk_test_51JpCdeCOL0GTP1VvSvJYJVcEg40ytN7Xxl8ZtbMGUCACD35i4kO31uIHaoCrvC4md2UeJRw0e3UrUrqOq2HWYkKL00yVJ7koBZ');

        $YOUR_DOMAIN = 'http://localhost:8080/Group8_PhoneStore/';

        $total = number_format(floatval(Cart::priceTotal()));

      $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
          'line_items' => [[
            'price_data' => [
              'currency' => 'usd',
              'product_data' => [
                'name' => 'Tổng thanh toán',
              ],
              'unit_amount' => $total,
            ],
            'quantity' => 1,
          ]],
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . 'user/success',
        'cancel_url' => $YOUR_DOMAIN . 'user/cancel',
      ]);
       return Redirect($checkout_session->url);
    }


      public function success(){
          return view("Home.ordersuccess");
      }
      public function cancel(){
          return view("Home.ordercancle");
      }
}
