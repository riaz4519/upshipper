@extends('layout_custom.user_view')

@section('css')
    <style>
        .red-border{
            border: 1px solid red;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="empty-space col-xs-b15 col-sm-b30"></div>
        <div class="breadcrumbs">
            <a href="#">home</a>
            <a href="#">checkout</a>
        </div>

        <div class="text-center">
            <div class="simple-article size-3 grey uppercase col-xs-b5">checkout</div>
            <div class="h2">check your info</div>
            <div class="title-underline center"><span></span></div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-b50 col-md-b0">
                <h4 class="h4 col-xs-b25">billing details</h4>

                <div class="empty-space col-xs-b20"></div>
                <div class="row m10">
                    <div class="col-sm-6">
                        <input class="simple-input firstName" type="text" value="" placeholder="First name" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                    <div class="col-sm-6">
                        <input class="simple-input lastName" type="text" value="" placeholder="Last name" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                </div>

                <div class="empty-space col-xs-b20"></div>
                <input class="simple-input address" type="text" value="" placeholder="Street address" />
                <div class="empty-space col-xs-b20"></div>
                <div class="row m10">
                    <div class="col-sm-6">
                        <input class="simple-input district" type="text" value="" placeholder="District" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                </div>
                <div class="row m10">
                    <div class="col-sm-6">
                        <input class="simple-input thana" type="text" value="" placeholder="Thana" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                    <div class="col-sm-6">
                        <input class="simple-input zip_code" type="text" value="" placeholder="Postcode/ZIP" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                </div>
                <div class="row m10">
                    <div class="col-sm-6">
                        <input class="simple-input email" type="text" value="" placeholder="Email" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                    <div class="col-sm-6">
                        <input class="simple-input phone" type="text" value="" placeholder="Phone" />
                        <div class="empty-space col-xs-b20"></div>
                    </div>
                </div>



                <div class="empty-space col-xs-b30 col-sm-b60"></div>
                <textarea class="simple-input note_order" placeholder="Note about your order"></textarea>
            </div>
            <div class="col-md-6">
                <h4 class="h4 col-xs-b25">your order</h4>
                @foreach($products as $index=>$product)

                    <div class="cart-entry clearfix">
                        <a class="cart-entry-thumbnail" href="#"><img style="max-width: 60px" src="{{ $product['image'] }}" alt=""></a>
                        <div class="cart-entry-description">
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="h7"><a href="#">{{ substr($product['productTitle'],0,20)."..." }}</a></div>
                                        <div class="simple-article size-1">QUANTITY: {{ $product['productQuantity'] }}</div>
                                    </td>
                                    <td>
                                        <div class="simple-article size-3 grey">$155.00</div>
                                        <div class="simple-article size-1">TOTAL: $310.00</div>
                                    </td>
                                    <td>
                                        <div class="cart-color" style="background: #eee;"></div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                @endforeach


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
                            <div class="color">{{ array_sum($shippingCharges) + array_sum($prices) }}</div>
                        </div>
                    </div>
                </div>
                <div class="empty-space col-xs-b50"></div>
                <h4 class="h4 col-xs-b25">payment method</h4>
                <select class="SlectBox">
                    <option selected="selected">Pay on Delivery</option>

                </select>

                <div class="empty-space col-xs-b30"></div>
                <div class="button block size-2 style-3 place_order">
                        <span class="button-wrapper ">
                            <span class="icon"><img src="img/icon-4.png" alt=""></span>
                            <span class="text ">place order</span>
                        </span>
                    <input type="submit"/>
                </div>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>


@endsection

@section('scripts')

    <script>
        $(document).ready(function () {

            $('.place_order').on('click',function () {
                let firstName =  $('.firstName').val();
                let lastName = $('.lastName').val();

                let address = $('.address').val();
                let district = $('.district').val();
                let thana  = $('.thana').val();

                let postCode  = $('.zip_code').val();

                let email = $('.email').val();
                let phone = $('.phone').val();

                let note_order = $('.note_order').val();




                if(firstName.length > 0 && lastName.length > 0 && address.length > 0 && district.length > 0 && thana.length > 0 && postCode.length >0 && email.length >0 && phone.length > 0){

                    console.log('filled');

                }else{

                    if (firstName.length <1){
                        $('.firstName').addClass('red-border');
                    }

                    if (lastName.length <1){
                        $('.lastName').addClass('red-border');
                    }

                    if (address.length <1){
                        $('.address').addClass('red-border');
                    }

                    if (district.length <1){
                        $('.district').addClass('red-border');
                    }

                    if (thana.length <1){
                        $('.thana').addClass('red-border');
                    }

                    if (postCode.length <1){
                        $('.zip_code').addClass('red-border');
                    }

                    if (email.length <1){
                        $('.email').addClass('red-border');
                    }else{
                        $('.email').css('border','1px solid red');
                    }

                    if (phone.length <1){
                        $('.phone').addClass('red-border');
                    }



                }
            })






        });
    </script>

    @endsection
