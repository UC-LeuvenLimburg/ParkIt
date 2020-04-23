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
            {{Form::label('user_id', 'User_id')}}
            {{Form::text('user_id', $user->id)}}
            {{Form::label('rentable_id', 'Rentable_id')}}
            {{Form::text('rentable_id', $rentable->id)}}
            @else
            {{Form::hidden('user_id', $user->id, ["hidden"])}}
            {{Form::hidden('rentable_id', $rentable->id, ["hidden"])}}
            @endif
            <div class="form-group">
                {{Form::label('start_time', 'Start Time')}}
                {{Form::time('start_time', '', ['class' => 'form-control', 'placeholer' => 'Start Time']) }}
            </div>
            <div class="form-group">
                {{Form::label('end_time', 'End Time')}}
                {{Form::time('end_time', '', ['class' => 'form-control', 'placeholer' => 'End Time']) }}
            </div>
            <div class="form-group">
                {{Form::label('price', 'Price/h')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&euro;</span>
                    </div>
                    {{Form::text('price', $rentable->price, ['class' => 'form-control', 'placeholer' => 'Date', 'disabled']) }}
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
            </div>
            {{Form::submit('Save', [ 'class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
