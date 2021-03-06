@extends('layout_custom.user_view')

@section('css')

    <style>
        .show-product-modal:hover{
            cursor: pointer;
        }
    </style>

    @endsection

@section('content')

    <div class="container">
        <div class="empty-space col-xs-b15 col-sm-b30"></div>
        <div class="breadcrumbs">
            <a href="#">home</a>
            <a href="#">shopping cart</a>
        </div>
{{--        <div class="empty-space col-xs-b15 col-sm-b50 col-md-b100"></div>
        <div class="text-center">
            <div class="simple-article size-3 grey uppercase col-xs-b5">shopping cart</div>
            <div class="h2">check your products</div>
            <div class="title-underline center"><span></span></div>
        </div>--}}
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>

    <div class="container">
        <table class="cart-table">
            <thead>
            <tr>
                <th style="width: 95px;"></th>
                <th>product name</th>
                <th style="width: 150px;">price</th>
                <th style="width: 260px;">quantity</th>
                <th style="width: 150px;">Shipping</th>
                <th style="width: 150px;">total</th>
                <th style="width: 70px;"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $index=>$product)
            <tr>
                <td data-title=" ">
                    <span class="cart-entry-thumbnail show-product-modal" data-cart-id="{{ $index }}"><img data-cart-id="{{$index}}" style="max-width: 60px" src="{{ $product['image'] }}" alt=""></span>
                </td>
                <td data-title=" " class="show-product-modal" data-cart-id="{{ $index }}"><h6 class="h6" data-cart-id="{{ $index }}">{{ $product['productTitle'] }}</h6></td>
                <td data-title="Price: ">{{ "$ ".$product['price'] }}</td>
                <td data-title="Quantity: ">
                    <div class="quantity-select">
                       {{-- <span class="minus"></span>--}}
                        <span class="number">{{ $product['productQuantity'] }}</span>
                        {{--<span class="plus"></span>--}}
                    </div>
                </td>
                <td data-title="Price: ">{{ "$ ".$product['shippingMethod']['charge'] }}</td>
                <td data-title="Total:">${{ $product['shippingMethod']['charge']+$product['price'] }}</td>
                <td data-title="">
                    <a class="dropdown-item"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form-{{ $index }}').submit();"><div class="button-close"></div></a>


                    <form id="logout-form-{{$index}}" action="{{ route('cart.remove',$index) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </td>
            </tr>
                @endforeach

            </tbody>
        </table>
        <div class="empty-space col-xs-b35"></div>
        <div class="row">
            <div class="col-sm-6 col-md-5 col-xs-b10 col-sm-b0">

            </div>
            <div class="col-sm-6 col-md-7 col-sm-text-right">
                <div class="buttons-wrapper">
                    <a class="button size-2 style-3" href="{{ route('checkout') }}">
                            <span class="button-wrapper">
                                <span class="icon"><img src="img/icon-4.png" alt=""></span>
                                <span class="text">proceed to checkout</span>
                            </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="empty-space col-xs-b35 col-md-b70"></div>
        <div class="row">
            <div class="col-md-6 col-xs-b50 col-md-b0">

            </div>
            @if(session()->exists('products'))
            <div class="col-md-6">
                <h4 class="h4">cart totals</h4>
                <div class="order-details-entry simple-article size-3 grey uppercase">
                    <div class="row">
                        <div class="col-xs-6">
                            cart subtotal
                        </div>
                        <div class="col-xs-6 col-xs-text-right">
                            <div class="color">${{ array_sum($prices) }}</div>
                        </div>
                    </div>
                </div>
                <div class="order-details-entry simple-article size-3 grey uppercase">
                    <div class="row">
                        <div class="col-xs-6">
                            shipping and handling
                        </div>
                        <div class="col-xs-6 col-xs-text-right">
                            <div class="color">${{ array_sum($shippingCharges) }}</div>
                        </div>
                    </div>
                </div>
                <div class="order-details-entry simple-article size-3 grey uppercase">
                    <div class="row">
                        <div class="col-xs-6">
                            order total
                        </div>
                        <div class="col-xs-6 col-xs-text-right">
                            <div class="color">${{ array_sum($prices) + array_sum($shippingCharges)}}</div>
                        </div>
                    </div>
                </div>
            </div>
                @endif
        </div>
        <div class="empty-space col-xs-b35 col-md-b70"></div>
        <div class="empty-space col-xs-b35 col-md-b70"></div>
    </div>

    <div class="popup-wrapper">
        <div class="bg-layer"></div>


        <div class="popup-content" data-rel="2">
            <div class="layer-close"></div>
            <div class="popup-container size-1">
                <div class="popup-align">
                    <h3 class="h3 text-center">register</h3>
                    <div class="empty-space col-xs-b30"></div>
                    <input class="simple-input" type="text" value="" placeholder="Your name" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" type="text" value="" placeholder="Your email" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" type="password" value="" placeholder="Enter password" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" type="password" value="" placeholder="Repeat password" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-7 col-xs-b10 col-sm-b0">
                            <div class="empty-space col-sm-b15"></div>
                            <label class="checkbox-entry">
                                <input type="checkbox" /><span><a href="#">Privacy policy agreement</a></span>
                            </label>
                        </div>
                        <div class="col-sm-5 text-right">
                            <a class="button size-2 style-3" href="#">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="img/icon-4.png" alt="" /></span>
                                    <span class="text">submit</span>
                                </span>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="button-close"></div>
            </div>
        </div>



    </div>


@endsection

@section('scripts')

    <script>
        $(document).ready(function () {

           $('.show-product-modal').on('click',function () {

               var dataCartId = $(this).attr('data-cart-id')
;
              //send ajax request for getting cart data
               $.ajax({
                   url:"{{ url('/') }}"+'//show-product/'+dataCartId,
                   type:"GET",
                   dataType:"JSON",
                   success:function (data) {
                      $('.popup-wrapper').addClass('active');
                      $('.product-show-modal').addClass('active');

                      $('.product-modal-title').text(data.productTitle);
                      $('.product-modal-image').attr('data-background',data.image);
                      $('.product-modal-image').css("background-image", "url("+data.image+")");

                      //product price
                       $('.product-modal-price').text(data.currency+" "+data.price);


                       $('.modal-product-show-sku').html('');

                       $.each(data.productSku,function (key,value) {
                          $('.modal-product-show-sku').append( '<div class="row col-xs-b40"> <div class="col-sm-3"> <div class="h6 detail-data-title">'+value.skuTitle+':</div> </div> <div class="col-sm-9"><div class="simple-article size-3">'+ value.skuValue +' </div></div> </div>')
                       });

                       //total price
                       $('.modal-total-price').text(data.currency+" "+ (parseFloat(data.price) + parseFloat(data.shippingMethod.charge)));

                       //shipping charge
                       $('.modal_shipping_charge').text(data.shippingMethod.currency +" "+data.shippingMethod.charge);

                       //shipping company

                       $('.modal_shipping_company').text(data.shippingMethod.company);

                       //shipping delivery time

                       $('.modal_delivery_time').text(data.shippingMethod.deliveryTime);

                       //product quantity

                       $('.modal_product_quantity').text(data.productQuantity);
                   }
               })



           })

        })
    </script>

    @endsection