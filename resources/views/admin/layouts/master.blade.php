<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ @$general->web_name }} | {{ $page_title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('public/images/logo/favicon.png') }}" sizes="16x16" />
    
    <!-- Inclui o CSS do Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @include('admin.layouts.partials.style')
    @yield('style')
</head>

<body>
    <div class="preloader">
        <div class="preloader-icon-img">
            <img src="{{ asset('public/images/logo/logo.gif') }}" alt="preloader spinner">
        </div>
    </div>

    @include('admin.layouts.partials.nav')

    <div class="body-area">
        @include('admin.layouts.sidebar')
        <main class="s7__main">
            <div class="s7__page-nav">
                <div class="left">
                    <h6 class="title text-uppercase">{{ $page_title }}</h6>
                </div>
                <div class="right">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">{{ __('Painel') }}</a></li>
                        <li>{{ $page_title }}</li>
                    </ul>
                </div>
            </div>
            @yield('content')
        </main>
    </div>

    <!-- Inclui o jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Inclui o JS do Bootstrap 5 -->
    <!-- Bootstrap 5 JS e Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>


    @include('admin.layouts.partials.script')
    @include('admin.layouts.partials.messages')
    @yield('script')
</body>

</html>
