@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>Edit Lease</h1>
            {!! Form::model($lease, ['route' => ['leases.update', $lease->id]]) !!}
            <div class="form-group">
                {{Form::label('start_time', 'Start Time')}}
                {{Form::time('start_time', $lease->start_time, ['class' => 'form-control', 'placeholer' => 'Start Time']) }}
            </div>
            <div class="form-group">
                {{Form::label('end_time', 'End Time')}}
                {{Form::time('end_time', $lease->end_time, ['class' => 'form-control', 'placeholer' => 'End Time']) }}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
