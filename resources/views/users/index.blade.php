@extends('layout_custom.user_view')

@section('content')

        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12">
                <div class="cell-view simple-banner-height text-center">


                    <h3 class="h3 col-xs-b15">AliExpress<span class="color">+</span>Amazon<span class="color">+</span>Ebay</h3>
                    <div class="simple-article size-3 col-xs-b25 col-sm-b50 ">**Only Aliexpres is available now**</div>
                    <form class="single-line-form" action="{{ route('detect.shop') }}">
                        <input class="simple-input" name="link" type="text" value="" placeholder="Enter your Link" required>
                        <div class="button size-2 style-3">
                                    <span class="button-wrapper">
                                        <span class="icon"><img src="{{ asset('asset/img/icon-4.png') }}" alt=""></span>
                                        <span class="text">submit</span>
                                    </span>
                            <input type="submit" value="">
                        </div>
                    </form>
                    <div class="empty-space col-xs-b35"></div>
                </div>
            </div>
        </div>
{{--        <div class="row-background left hidden-xs">
            <img src="{{ asset('asset/img/background-8.jpg') }}" alt="" />
        </div>--}}



@endsection