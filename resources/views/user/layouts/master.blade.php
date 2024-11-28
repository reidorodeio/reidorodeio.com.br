<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('frontend.layouts.partials.seo')
    <title>{{ __(@$general->web_name) }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('public/images/logo/favicon.png') }}" type="image/png">
    @yield('css')
</head>

<body class="bg-black">

    @include('frontend.layouts.partials.nav')

    <div class="main-body-area">
        <div class="row">
            <div class="row">
                <!--<h4 class="section-title-menu">{{ $page_title }}</h4> -->
                @yield('content')
            </div>
        </div>
    </div>

    @include('frontend.layouts.partials.footer')

    @include('frontend.layouts.partials.script')
    @include('frontend.layouts.partials.messages')
    @yield('script')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/65170ef610c0b2572486f190/1hbh14t3s';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>

</html>
