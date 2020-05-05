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
            <h4>Please wait a moment. You will be redirected in <span id="countdowntimer">5 </span> Seconds</h4>
            <p>Wan't to go to the page now? Click <a href="/myleases"> here </a></p>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    var timeleft = 5;
    var timer = setInterval(function(){
    if(timeleft <=0){
        clearInterval(downloadTimer);
    }
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    },1000);
</script>
