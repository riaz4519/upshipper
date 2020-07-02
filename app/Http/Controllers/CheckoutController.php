<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //

    public function index(){

        $products  = [];
        if (session()->exists('products')){
            $products = session()->get('products');
            $data['prices'] = array_column($products,'price');
            //shipping charges
            $data['shippingCharges'] = array_column(array_column($products,'shippingMethod'),'charge');


        }

        $data['products'] = $products;

        return view('checkout.checkout')->with($data);
    }
}
