<head>
    <meta http-equiv="refresh" content="5; URL=/myleases" />
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            @php

            @endphp
            <h4 id="countdown">Please wait a moment.</h4>
            <p>If redirect fails. Click <a href="/myleases"> here </a></p>
        </div>
    </div>
</div>
@endsection

<script>
    var timeleft = 5;
    var timer = setInterval(function(){
    if(timeleft <= 0)
    {
        clearInterval(timer);
    }
    else
    {
        document.getElementById("countdown").innerHTML="Please wait a moment. You will be redirected in " + timeleft + " s" ;
    }
    timeleft -=1;
}, 1000);
</script>
