@extends('main')
@section('title', 'View Class')
@section('content')
    <form method="post" action="{{ route('login.submit') }}" class="w3-display-middle w3-margin-top">
        @csrf
        <div class="w3-container w3-padding">
        <br/>
        <br/>
        <b><input class="w3-input w3-border w3-small" style="padding:15px" type="text" id="username" name="auth_user" placeholder="Username / Phone"><br>
        <input class="w3-input w3-border w3-small"  style="padding:15px" type="password" id="pwd" name="auth_pass" placeholder="Password"><br><br></b>
        <div class="w3-row w3-right">
            <input type="submit" value="Signin" class="w3-btn redtheme w3-round-large">
            </div>
        </div>
    </form>
    <div class="download w3-margin-top w3-center" style="position:fixed;bottom:0;width:100%;">
        <br/>
        <a href="{bits}base.apk" class="redfont w3-margin-top w3-btn w3-round-large w3-border w3-card" download>
        Download App
        </a>
        <br>
        <span style='font-size:10px'>Developed by <a href="www.breakshell1.com" class="bluefont">Ian Bryan Banda</a></span>
    </div>
@endsection
