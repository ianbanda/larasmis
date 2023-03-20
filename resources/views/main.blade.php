<!-- resources/views/layouts/master.blade.php -->
<html>
    <head>
        <title>@yield('title', 'Home Page')</title>
        <link rel="stylesheet" href="{{asset('css/css.css')}}">
        <link rel="stylesheet" href="{{asset('css/w3.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        
    </head>
    <body>
        <div id = 'msg'>This message will be replaced using Ajax. 
            Click the button to replace the message.</div>
        
         @csrf
         
         <button onclick="getMessage()">Click to see</button>

        <div class="container">
            @yield('content')
        </div>
            @section('footerScripts')
            <!--<script src="app.js"></script>-->
            <script  type="text/javascript" src="{{asset('js/custom.js')}}"></script>
        @show
    </body>
</html>