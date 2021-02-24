<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> 

    {{-- <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!--Fontawesome-->
    <script src="https://kit.fontawesome.com/c490523a50.js" crossorigin="anonymous"></script>
    <title>{{config('app.name','DSC')}}</title>
    </head>
    <body>
        <div id="DSC">
        @auth
        @include('inc.navbar')
        @endauth
        <div class="row">
            @auth
            <div class="col-1">
                @include('inc.sidebar')
            </div>
            <div class="col-11">
            @else
            <div class="col-12">
            @endauth
                @include('inc.messages')
                @yield('content')
            </div>
            @auth
            @include('inc.footer')
            @endauth
        </div>
        </div>
        <!--Javascript-->
        <!-- Scripts -->
    <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
    CKEDITOR.replace( 'article-ckeditor' );
    </script>
    </body>
</html>
