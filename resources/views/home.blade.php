@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <h1 class="display-5">Welcome to Parkit</h1>
                <p class="lead">To use our service please login.</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="#" role="button">Login</a>
                </p>
                <hr class="my-4">
                <h3 class="display-6" class="lead">What do we offer?</h3>
                <p>We offer a service that makes it possible to hire or lease a parking spot.
                    <img src="images/parking.jpg">
                </p>
            </div>
        </div>
    </div>
</div>
@endsection