<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart'); // or however you're storing cart

        return view('checkout.index', compact('cart'));
    }
}
