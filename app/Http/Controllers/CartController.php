<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function cart(){


        $products  = [];
        if (session()->exists('products')){
            $products = session()->get('products');
            $data['prices'] = array_column($products,'price');
            //shipping charges
            $data['shippingCharges'] = array_column(array_column($products,'shippingMethod'),'charge');


        }

        $data['products'] = $products;


        return view('cart.aliexpress')->with($data);

    }
    public function remove($id){

        $products = session()->get('products');
        array_splice($products,$id,1);
        session()->forget('products');

        if (count($products) >0){

            session()->put('products',$products);
        }



       return redirect()->back();



    }
}
