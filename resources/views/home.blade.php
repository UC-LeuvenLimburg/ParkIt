@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-4">Welcome to ParkIt</h1>
            <div class="home-background-gray">
                <h3 class="display-6" class="lead">What do we offer?</h3>
                <p>We offer a service that makes it possible to rent or lease a parking spot.
                    <div class="row justify-content-center">
                        <img src="{{ asset('images/parking.jpg') }}" class="img-responsive" alt="parking image">
                    </div>
                </p>
                @guest

                <hr class="my-4">
                <p class="lead">To use our service you are required to have an account</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="/register" role="button">Sign up</a>
                </p>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection