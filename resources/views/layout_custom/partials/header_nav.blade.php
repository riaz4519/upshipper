<header>
    <div class="header-top">
        <div class="content-margins">
            <div class="row">
                <div class="col-md-5 hidden-xs hidden-sm">
                    <div class="entry"><b>contact us:</b> <a href="tel:+35235551238745">+3  (523) 555 123 8745</a></div>
                    <div class="entry"><b>email:</b> <a href="mailto:office@exzo.com">office@exzo.com</a></div>
                </div>
                <div class="col-md-7 col-md-text-right">
                    <div class="entry"><a class="open-popup" data-rel="1"><b>login</b></a>&nbsp; or &nbsp;<a class="open-popup" data-rel="2"><b>register</b></a></div>
                    <div class="entry hidden-xs hidden-sm cart">
                        <a href="{{ url('/cart') }}">
                            <b class="hidden-xs">Your bag</b>
                            <span class="cart-icon">
                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        <span class="cart-label">@if(session()->exists('products')) {{ count(session()->get('products')) }}@else {{ '0' }} @endif</span>
                                    </span>
                           {{-- <span class="cart-title hidden-xs">$1195.00</span>--}}
                        </a>
                        <div class="cart-toggle hidden-xs hidden-sm">
                            <div class="cart-overflow">
                                @if(session()->exists('products'))
                                @foreach(session()->get('products') as $product)
                                <div class="cart-entry clearfix">
                                    <a class="cart-entry-thumbnail" href="#"><img style="max-width: 60px" src="{{ $product['image'] }}" alt="" /></a>
                                    <div class="cart-entry-description">
                                        <table>

                                            <tr>
                                                <td>
                                                    <div class="h6"><a href="#">{{ substr($product['productTitle'],0,12)."..." }}</a></div>
                                                    <div class="simple-article size-1">QUANTITY: {{ $product['productQuantity'] }}</div>
                                                </td>
                                                <td>
                                                    <div class="simple-article size-3 grey">${{ $product['price'] }}</div>
                                                    <div class="simple-article size-1">TOTAL: ${{ $product['shippingMethod']['charge'] + $product['price'] }}</div>
                                                </td>
                                                <td>
                                                    <div class="cart-color">{{ $product['productQuantity'] }}</div>
                                                </td>
                                                <td>
                                                    <div class="button-close"></div>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                                @endforeach
                                @endif

                            </div>
                            <div class="empty-space col-xs-b40"></div>
                            <div class="row">
                                <div class="col-xs-6">
                                    @if(session()->exists('products'))
                                    <div class="cell-view empty-space col-xs-b50">
                                        @php
                                        $products = session()->get('products');
                                        $prices = array_column($products,'price');
                                        //shipping charges
                                        $shippingCharges = array_column(array_column($products,'shippingMethod'),'charge');



                                        @endphp

                                        <div class="simple-article size-5 grey">TOTAL <span class="color">${{ array_sum($prices) + array_sum($shippingCharges) }}</span></div>
                                    </div>
                                        @endif
                                </div>
                                <div class="col-xs-6 text-right">
                                    <a class="button size-2 style-3" href="{{ url('/cart') }}">
                                                <span class="button-wrapper">
                                                    <span class="icon"><img src="{{ asset('asset/img/icon-4.png') }}" alt=""></span>
                                                    <span class="text">Proceed To Cart</span>
                                                </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="content-margins">
            <div class="row">
                <div class="col-xs-3 col-sm-1">
                    <a id="logo" href="{{ url('/') }}"><img src="{{ asset('image/up_shipper_logo.png') }}" alt="" /></a>
                </div>
                <div class="col-xs-9 col-sm-11 text-right">
                    <div class="nav-wrapper">
                        <div class="nav-close-layer"></div>
                        <nav>
                            <ul>
                                <li class="active">
                                    <a href="{{ url('/') }}">Home</a>
                                </li>
                                <li>
                                    <a href="about1.html">about us</a>
                                </li>
                                <li class="megamenu-wrapper">
                                    <a href="products1.html">products</a>

                                </li>
                                <li>
                                    <a href="{{ url('/cart') }}">Cart</a>
                                </li>

                                <li><a href="contact1.html">contact</a></li>
                            </ul>
                            <div class="navigation-title">
                                Navigation
                                <div class="hamburger-icon active">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </nav>
                    </div>

                </div>
            </div>

        </div>
    </div>

</header>