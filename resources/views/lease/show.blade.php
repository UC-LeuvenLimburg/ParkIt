@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <div class="card">

                <div class="card-header">Leases</div>

                <div class="card-body">
                    <div>{{ $lease->start_time }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
