<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        @include('frontend.layouts.partials.seo')
        <title>{{ __(@$general->web_name) }}</title>
        <link rel="shortcut icon" href="{{ asset('public/images/logo/favicon.png') }}" type="image/png">
    </head>
    

<body>
    @include('frontend.layouts.partials.nav')

    @yield('content')

    @include('frontend.layouts.partials.footer')
    @include('frontend.layouts.partials.script')
    @include('frontend.layouts.partials.messages')

    @yield('script')
    <script>
        // Aguarda o carregamento completo da página e, então, oculta o preloader
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.querySelector('.preloader').classList.add('hidden');
            }, 1500); // 1.5 segundos
        });
    </script>
</body>

</html>
