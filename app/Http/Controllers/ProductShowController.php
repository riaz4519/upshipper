<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;

class ProductShowController extends Controller
{
    //


    public function detectShop(Request $request){

        $parsed_link = parse_url($request->get('link'));

       if (array_key_exists('host',$parsed_link)){
           if ($parsed_link['host'] == 'www.aliexpress.com'){
               $link = $parsed_link['scheme']."://".$parsed_link['host'].$parsed_link['path'];

               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $link);
               curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               $response = curl_exec($ch);
               curl_close($ch);

               $product_id = substr($parsed_link['path'],strlen("/item/"),strpos($parsed_link['path'],".html")-strlen("/item/"));
               $data['link'] = $link;
               $data['product_id'] = $product_id;

               return view('products.aliexpress')->with('response',$response)->with($data);
           }
           else{
               return abort('404');
           }

       }else{
           $link = "https://www.aliexpress.com/wholesale?SearchText=".$request->get('link');

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $link);
           curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           $response = curl_exec($ch);
           curl_close($ch);

           return $response;


       }





    }

    //post request product saving to session
    public function saveProductToCart(Request $request){

        //product session exists we will search for the product a se if there is any changes
        if (session()->exists('products')){

            //get products from session
           $products = session()->get('products');

           //check newly added product is added on the session
           if (in_array($request->get('product')['link'],array_column($products,'link'))){

               //get the key or index of the product stored in the session
               $key = array_search($request->get('product')['link'],array_column($products,'link'));

               //checking for product sku match if all match then we just simply update the quantity
                   foreach ($products[$key]['productSku'] as $skuKey=>$productSku){

                       //check if sku property miss or not
                       if ($productSku['skuValue'] != $request->get('product')['productSku'][$skuKey]['skuValue']){
                           $request->session()->push('products',$request->get('product'));
                           break;
                       }

                       //if all the sku matched update
                       if (count($products[$key]['productSku'])-1 == $skuKey){
                           //quantity update
                           $products[$key]['productQuantity'] +=  $request->get('product')['productQuantity'];

                            //shipping method update
                          $shippingCompany = $request->get('product')['shippingMethod']['company'];
                            //sending request for current shipping method with total quantity
                           $cURLConnection = curl_init();

                           curl_setopt($cURLConnection, CURLOPT_URL, "https://aep.ali2bd.com/freight/?productId=".$products[$key]['product_id']."&count=".$products[$key]['productQuantity']."&minPrice=".$products[$key]['price']."&maxPrice=".$products[$key]['price']."&sendGoodsCountry=CN&country=BD&tradeCurrency=USD&userScene=PC_DETAIL");
                           curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

                           $response = json_decode(curl_exec($cURLConnection));
                           curl_close($cURLConnection);
                            //get the index of shipping method which is selected by the customer
                           $indexShippingMethod = array_search($shippingCompany,array_column($response->body->freightResult,'company'));
                           $shippingMethodData = $response->body->freightResult[$indexShippingMethod];
                           $products[$key]['shippingMethod'] = [
                               'charge' =>$shippingMethodData->standardFreightAmount->value,
                               'currency' =>$shippingMethodData->standardFreightAmount->currency,
                               'company' =>$shippingMethodData->company,
                               'deliveryTime' =>$shippingMethodData->time,

                           ];

                           //update the session
                            session()->put('products',$products);
                       }
                   }




               }

           else{
               $request->session()->push('products',$request->get('product'));
           }

        }
        //if this there no product the we will directly enter the product
        else{
            $request->session()->push('products',$request->get('product'));
        }


        return 1;

    }







}
