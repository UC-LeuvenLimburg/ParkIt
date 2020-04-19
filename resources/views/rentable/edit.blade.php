@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>Edit Place</h1>
            {!! Form::model($rentable, ['route' => ['rentables.update', $rentable], 'method' => 'PUT']) !!}
            <div class="form-group">
                {{Form::label('user', 'Owner')}}
                {{Form::text('user', $rentable->user->name, ['class' => 'form-control', 'placeholer' => 'User', 'disabled']) }}
            </div>
            <div class="form-group">
                {{Form::label('adress', 'Adress')}}
                {{Form::text('adress', $rentable->adress, ['class' => 'form-control', 'placeholer' => 'Adress']) }}
            </div>
            <div class="form-group">
                {{Form::label('postal_code', 'Postal code')}}
                {{Form::text('postal_code', $rentable->postal_code, ['class' => 'form-control', 'placeholer' => 'PostalCode']) }}
            </div>
            <div class="form-group">
                {{Form::label('date', 'Date')}}
                {{Form::date('date', $rentable->date_of_hire, ['class' => 'form-control', 'placeholer' => 'Date']) }}
            </div>
            <div class="form-group">
                {{Form::label('start_time', 'Start Time')}}
                {{Form::time('start_time', $rentable->start_time_rp, ['class' => 'form-control', 'placeholer' => 'Start Time']) }}
            </div>
            <div class="form-group">
                {{Form::label('end_time', 'End Time')}}
                {{Form::time('end_time', $rentable->end_time_rp, ['class' => 'form-control', 'placeholer' => 'End Time']) }}
            </div>
            <div class="form-group">
                {{Form::label('price', 'Price/h')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&euro;</span>
                    </div>
                    {{Form::text('price', $rentable->price, ['class' => 'form-control', 'placeholer' => 'Price']) }}
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('bankaccount_nr', 'Bankaccount Number')}}
                    {{Form::text('bankaccount_nr', $rentable->bankaccount_nr, ['class' => 'form-control', 'placeholer' => 'Bankaccount number']) }}
                </div>
                <div class="form-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::text('description', $rentable->description, ['class' => 'form-control', 'placeholer' => 'Description']) }}
                </div>
            </div>
            {{Form::submit('Save', [ 'class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection