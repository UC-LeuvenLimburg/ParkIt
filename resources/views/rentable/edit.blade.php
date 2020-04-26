@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>Edit Place</h1>
            {!! Form::model($rentable, ['route' => ['rentables.update', $rentable], 'method' => 'PUT']) !!}
            {{Form::hidden('rentable_id', $rentable->id, ['hidden', 'required'])}}
            <div class="form-group">
                {{Form::label('owner', 'Owner')}}
                {{Form::email('owner', $rentable->user->email, ['class' => 'form-control', 'placeholer' => 'User', 'readonly']) }}
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    {{Form::label('adress', 'Adress')}}
                    {{Form::text('adress', $rentable->adress, ['class' => 'form-control', 'placeholer' => 'Adress', 'required']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('postal_code', 'Postal code')}}
                    {{Form::text('postal_code', $rentable->postal_code, ['class' => 'form-control', 'placeholer' => 'PostalCode', 'required']) }}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    {{Form::label('date_of_hire', 'Date')}}
                    {{Form::date('date_of_hire', $rentable->date_of_hire, ['class' => 'form-control', 'placeholer' => 'Date', 'required']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('start_time', 'Start Time')}}
                    {{Form::time('start_time', $rentable->start_time, ['class' => 'form-control', 'placeholer' => 'Start Time', 'required']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('end_time', 'End Time')}}
                    {{Form::time('end_time', $rentable->end_time, ['class' => 'form-control', 'placeholer' => 'End Time', 'required']) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('price', 'Price/h')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&euro;</span>
                    </div>
                    {{Form::number('price', $rentable->price, ['class' => 'form-control', 'placeholer' => 'Price', 'step' => '.01', 'required']) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('bankaccount_nr', 'Bankaccount Number')}}
                {{Form::text('bankaccount_nr', $rentable->bankaccount_nr, ['class' => 'form-control', 'placeholer' => 'Bankaccount number', 'required']) }}
            </div>
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', $rentable->description, ['class' => 'form-control', 'placeholer' => 'Description', 'required']) }}
            </div>
            {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
            <div class="parkit-delete-button">
                {!! Form::open(['action' => ['RentableController@destroy', $rentable], 'method' => 'POST']) !!}
                @if (Auth::user()->role==="admin")
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
