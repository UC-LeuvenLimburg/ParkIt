@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h1>Create Place</h1>
            {!! Form::open(['route' => 'rentables.store']) !!}
            @if (Auth::user()->role==="admin")
            <div class="form-group">
                {{Form::label('user_id', 'User Email')}}
                <user-autocomplete />
            </div>
            @else
            {{Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control', 'placeholer' => 'User_id', 'hidden', 'required']) }}
            @endif
            <div class="form-row">
                <div class="form-group col-md-8">
                    {{Form::label('adress', 'Adress')}}
                    {{Form::text('adress', '', ['class' => 'form-control', 'placeholer' => 'Adress', 'required']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('postal_code', 'Postal code')}}
                    {{Form::text('postal_code', '', ['class' => 'form-control', 'placeholer' => 'PostalCode', 'required']) }}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    {{Form::label('date_of_hire', 'Date')}}
                    {{Form::date('date_of_hire', '', ['class' => 'form-control', 'placeholer' => 'Date', 'required']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('start_time', 'Start Time')}}
                    {{Form::time('start_time', '', ['class' => 'form-control', 'placeholer' => 'Start Time', 'required']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('end_time', 'End Time')}}
                    {{Form::time('end_time', '', ['class' => 'form-control', 'placeholer' => 'End Time', 'required']) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('price', 'Price/h')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&euro;</span>
                    </div>
                    {{Form::number('price', '', ['class' => 'form-control', 'placeholer' => 'Price', 'step' => '.01', 'required']) }}
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
            {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
