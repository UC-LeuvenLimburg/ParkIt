@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>Create Place</h1>
            {!! Form::open(['route' => 'rentables.store']) !!}
            @if (Auth::user()->role==="admin")
            <div class="form-group">
                {{Form::label('user_id', 'User_id')}}
                {{Form::number('user_id', '', ['class' => 'form-control', 'placeholer' => 'User_id', 'required']) }}
            </div>
            @else
            {{Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control', 'placeholer' => 'User_id', 'hidden', 'required']) }}
            @endif
            <div class="form-group">
                {{Form::label('adress', 'Adress')}}
                {{Form::text('adress', '', ['class' => 'form-control', 'placeholer' => 'Adress', 'required']) }}
            </div>
            <div class="form-group">
                {{Form::label('postal_code', 'Postal code')}}
                {{Form::text('postal_code', '', ['class' => 'form-control', 'placeholer' => 'PostalCode', 'required']) }}
            </div>
            <div class="form-group">
                {{Form::label('date_of_hire', 'Date')}}
                {{Form::date('date_of_hire', '', ['class' => 'form-control', 'placeholer' => 'Date', 'required']) }}
            </div>
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
                    {{Form::text('price', '', ['class' => 'form-control', 'placeholer' => 'Price', 'required']) }}
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('bankaccount_nr', 'Bankaccount Number')}}
                    {{Form::text('bankaccount_nr', '', ['class' => 'form-control', 'placeholer' => 'Bankaccount number', 'required']) }}
                </div>
                <div class="form-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::text('description', '', ['class' => 'form-control', 'placeholer' => 'Description', 'required']) }}
                </div>
            </div>
            {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
