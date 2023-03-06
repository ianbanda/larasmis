<!-- resources/views/layouts/master.blade.php -->
<html>
    <head>
        <title>@yield('title', 'Home Page')</title>
        <link rel="stylesheet" href="{{asset('css/css.css')}}">
        <link rel="stylesheet" href="{{asset('css/w3.css')}}">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
            @section('footerScripts')
        <script src="app.js"></script>
        @show
    </body>
</html>