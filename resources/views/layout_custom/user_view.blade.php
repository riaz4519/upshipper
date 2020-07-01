
{{--header --}}
@include('layout_custom.partials.head_info')

<body class="fonts-1">

<!-- LOADER -->
<div id="loader-wrapper"></div>

<div id="content-block">
    <!-- HEADER -->

    @include('layout_custom.partials.header_nav')

    {{--header end--}}

    <div class="header-empty-space"></div>

    <div class="container">

        @yield('content')


    </div>


    <div class="empty-space col-xs-b15 col-sm-b45"></div>
    <div class="empty-space col-md-b70"></div>

    <!-- FOOTER -->

    @include('layout_custom.partials.footer_form')

    {{--footer--}}

    @include('layout_custom.partials.footer')

    @include('layout_custom.partials.pop_up')


</div>




@include('layout_custom.partials.footer_info')

@yield('scripts')





</body>
</html>
