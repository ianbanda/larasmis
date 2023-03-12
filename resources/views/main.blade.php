<!-- resources/views/layouts/master.blade.php -->
<html>
    <head>
        <title>@yield('title', 'Home Page')</title>
        <link rel="stylesheet" href="{{asset('css/css.css')}}">
        <link rel="stylesheet" href="{{asset('css/w3.css')}}">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script  type="text/javascript" src="{{asset('js/custom.js')}}"></script>
        <script>
            /*function getMessage() {
                    
                $.get("/getmsg", function(data, status){
                    alert("Data: " + data + "\nStatus: " + status);
                });         
            }*/
            /*$(document).ready(
                function(){
                    alert("Hello");
                }
            );*/
         </script>
    </head>
    <body>
        <div id = 'msg'>This message will be replaced using Ajax. 
            Click the button to replace the message.</div>
         <?php
            //echo Form::button('Replace Message',['onClick'=>'getMessage()']);
         ?>
         @csrf
         
         <button onclick="getMessage()">Click to see</button>

        <div class="container">
            @yield('content')
        </div>
            @section('footerScripts')
        <script src="app.js"></script>
        @show
    </body>
</html>