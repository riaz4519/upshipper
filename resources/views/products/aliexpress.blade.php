<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>

    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="load-ali" style="display: none;">
        {!! $response !!}

    </div>
</div>


</body>
</html>


<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>

    $(document).ready(function () {

        $('#header').hide();
        $('.store-header-bg').hide();
        $('#top-lighthouse').hide();
        $('.store-header-nav').hide();
        $('.detail-fixed-tab').remove();
        $('.banner').hide();
        $('.product-extend-sidebar').hide();
        $('.cross-link').hide();
        $('.site-footer').hide();
        $('.footer-copywrite').hide();
        $('.product-fix-sns').hide();
        $('.banner-big-sale-wrap').hide();
        $('.buy-now-wrap').hide();
        $('.product-action').hide();
        $('.product-shipping').hide();
        $('.load-ali').show();
        function getPrice(){
            var Test = $('.product-price-value').eq(0).text();
            var Regex = /[+-]?\d+(\.\d+)?/g;
            return  Test.match(Regex).map(function(v) { return parseFloat(v); });
        }

        //product currency
        function productCurrency() {
            var price = $('.product-price-value').eq(0).text();

            return price.substr(0,price.indexOf(' '));

        }
        productCurrency();

        //get price
        function getMaxMinPrice(priceArray) {
            var priceObj ={};
            if (priceArray.length >1){

                priceObj.minPrice = priceArray[0];
                priceObj.maxPrice = priceArray[1];

            } else{
                priceObj.minPrice = priceArray[0];
                priceObj.maxPrice = priceArray[0];
            }

            return priceObj;
        }

        //get shipping method
        function getShiping(productPrice,count) {


            $.ajax({
                url:"https://aep.ali2bd.com/freight/?productId="+"{{ $product_id }}"+"&count="+count+"&minPrice="+productPrice.minPrice+"&maxPrice="+productPrice.maxPrice+"&sendGoodsCountry=CN&country=BD&tradeCurrency=USD&userScene=PC_DETAIL",
                dataType:"JSON",
                success:function (data) {
                     datas = data.body.freightResult;
                     var list = '<div class="form-group p-4"><label>Shipping methods</label><select name="shippingMethod" class="custom_select form-control" id="methodList">';
                     datas.forEach(function (data) {
                        list += '<option data-delivery-time="'+data.time+'" data-charge="'+data.standardFreightAmount.value+'" data-currency="'+data.standardFreightAmount.currency+'" data-service-company="'+data.company+'">'+data.company+"-(Time: "+data.time+" days)- "+data.standardFreightAmount.formatedAmount+'</option>';
                     });
                    list += '</select></div>';
                    $('.shipping_method').html('');
                    $('.shipping_method').append(list);
                }
            });

        }

        //shipping only china
        function shipFormChina() {
            //ship from if exists enable china and disable all
            $('.sku-title').each(function (index) {

                if ($(this).contents().first().text() === 'Ships From') {
                    $(this).next().children().each(function () {
                        if ($(this).text() !== 'CHINA') {
                            $(this).addClass('disabled');
                        }
                    });
                }

            });
        }

        //send first ajax call for getting the shipping method
        var productPrice = getMaxMinPrice(getPrice());
        getShiping(productPrice,$('.product-quantity').children().eq(1).children().eq(0).children().eq(1).children().first().val());

        //adding drop downlist
        $('.product-warranty').append('<div class="shipping_method"></div>');
        //adding cart button
        $('.product-warranty').append('<button class="add-to-card-data btn btn-info btn-lg">Add To Cart</button>');

        //on price change get the shipping method
        $('.product-price-value').eq(0).on('DOMSubtreeModified',function () {

            var productPrice = getMaxMinPrice(getPrice());
            getShiping(productPrice,$('.product-quantity').children().eq(1).children().eq(0).children().eq(1).children().first().val());


        });

        //on quantity change get shipping methods

        $('.product-quantity').children().eq(1).children().eq(0).children().eq(1).children().first().on('DOMSubtreeModified',function () {
            var productPrice = getMaxMinPrice(getPrice());
            getShiping(productPrice,$(this).val());

        });

        //ship from china
        shipFormChina();

        //on change any sku property

        $('.sku-title').each(function (index) {

            $(this).on('DOMSubtreeModified',function () {
                shipFormChina();
                var productPrice = getMaxMinPrice(getPrice());
                getShiping(productPrice,$('.product-quantity').children().eq(1).children().eq(0).children().eq(1).children().first().val());


            })



        });


       //when click add to cart button
       $('.add-to-card-data').on('click',function () {
          if ( !$('.buy-now-wrap').is("[aria-expanded]")){
              var product = {
                  productSku:[]
              };

              //get the title
              product.productTitle = $('.product-title-text').text();

              //get the quantity
              product.productQuantity = $('.product-quantity').children().eq(1).children().eq(0).children().eq(1).children().first().val();

              $('.sku-title').each(function (index) {
                 product.productSku.push({
                    skuTitle: $(this).contents().first().text(),
                    skuValue: $(this).children().text()
                 });

              });
              product.image = $('.magnifier-image').attr('src');
              var productPrice = getMaxMinPrice(getPrice());
              product.price = productPrice.minPrice;
              product.currency = productCurrency();
              product.link = "{{ $link }}";
              product.shippingMethod = {};
              product.platform = "aliexpress";

              var paymentMethod = $('#methodList option:selected');

              product.shippingMethod.charge =  paymentMethod.attr('data-charge');
              product.shippingMethod.currency =  paymentMethod.attr('data-currency');
              product.shippingMethod.company =  paymentMethod.attr('data-service-company');

              product.shippingMethod.deliveryTime =  paymentMethod.attr('data-delivery-time');
              product.product_id = "{{$product_id}}";

              $.ajax({
                  url:"{{ url('/product/cart') }}",
                  type:"POST",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  dataType:"JSON",
                  data:{

                      product:product
                  },
                  success:function (data) {

                      window.location.href = "{{ url('/cart') }}";

                  }
              })
          }
       });


    })
</script>
