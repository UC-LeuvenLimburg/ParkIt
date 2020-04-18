@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <div class="card">

                <div class="card-header">Lease</div>

                <div class="card-body">
                    <div>Adress: {{ $lease->rentable->adress }}</div>
                    <div>Date: {{ $lease->rentable->date_of_hire }}</div>
                    <div>Start Time: {{ $lease->start_time }}</div>
                    <div>Start Time: {{ $lease->start_time }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
