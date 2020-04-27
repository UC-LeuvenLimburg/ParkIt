@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>Create Lease</h1>
            {!! Form::open(['route' => 'leases.store']) !!}
            <div class="form-group">
                {{Form::label('adress', 'Adress')}}
                {{Form::text('adress', $rentable->adress, ['class' => 'form-control', 'placeholer' => 'Adress', 'disabled']) }}
            </div>
            <div class="form-group">
                {{Form::label('date', 'Date')}}
                {{Form::date('date', $rentable->date_of_hire, ['class' => 'form-control', 'placeholer' => 'Date', 'disabled']) }}
            </div>
            @if (Auth::user()->role==="admin")
            <div class="form-group">
                {{Form::label('user_id', 'User Email')}}
                <user-autocomplete />
            </div>
            <div class="form-group">
                {{Form::label('rentable_id', 'Place')}}
                <rentable-autocomplete />
            </div>
            @else
            {{Form::hidden('user_id', $user_id, ['hidden', 'required'])}}
            {{Form::hidden('rentable_id', $rentable->id, ['hidden', 'required'])}}
            @endif
            <div class="form-group">
                {{Form::label('start_time', 'Start Time')}}
                {{Form::time('start_time', '', ['class' => 'form-control', 'placeholer' => 'Start Time', 'required']) }}
            </div>
            <div class="form-group">
                {{Form::label('end_time', 'End Time')}}
                {{Form::time('end_time', '', ['class' => 'form-control', 'placeholer' => 'End Time', 'required']) }}
            </div>
            <div class="form-group">
                {{Form::label('price', 'Price/h')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&euro;</span>
                    </div>
                    {{Form::text('price', $rentable->price, ['class' => 'form-control', 'placeholer' => 'Date', 'disabled']) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('phone_nr', 'Phone number')}}
                {{Form::text('phone_nr', '', ['class' => 'form-control', 'placeholer' => 'phone_nr', 'required']) }}
            </div>
            <div class="form-group">
                {{Form::label('license_plate', 'License plate')}}
                {{Form::text('license_plate', '', ['class' => 'form-control', 'placeholer' => 'license_plate', 'required']) }}
            </div>
            @if (Auth::user()->role==="admin")
            {{Form::submit('Save', [ 'class' => 'btn btn-primary'])}}
            @else
            {{Form::submit('Pay', [ 'class' => 'btn btn-primary'])}}
            @endif
            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection