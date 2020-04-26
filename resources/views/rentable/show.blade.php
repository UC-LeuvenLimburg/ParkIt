@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>Place details</h1>
            {!! Form::model($rentable) !!}
            @if (Auth::user()->role==="admin")
            <div class="form-group">
                {{Form::label('owner', 'Owner')}}
                {{Form::email('owner', $rentable->user->email, ['class' => 'form-control', 'placeholer' => 'Email', 'readonly']) }}
            </div>
            @endif
            <div class="form-row">
                <div class="form-group col-md-8">
                    {{Form::label('adress', 'Adress')}}
                    {{Form::text('adress', $rentable->adress, ['class' => 'form-control', 'placeholer' => 'Adress', 'readonly']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('postal_code', 'Postal code')}}
                    {{Form::text('postal_code', $rentable->postal_code, ['class' => 'form-control', 'placeholer' => 'PostalCode', 'readonly']) }}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    {{Form::label('date', 'Date')}}
                    {{Form::date('date', $rentable->date_of_hire, ['class' => 'form-control', 'placeholer' => 'Date', 'readonly']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('start_time', 'Start Time')}}
                    {{Form::time('start_time', $rentable->start_time, ['class' => 'form-control', 'placeholer' => 'Start Time', 'readonly']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('end_time', 'End Time')}}
                    {{Form::time('end_time', $rentable->end_time, ['class' => 'form-control', 'placeholer' => 'End Time', 'readonly']) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('price', 'Price/h')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&euro;</span>
                    </div>
                    {{Form::text('price', $rentable->price, ['class' => 'form-control', 'placeholer' => 'Date', 'readonly']) }}
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role==="admin")
            <div class="form-group">
                {{Form::label('bancaccount_nr', 'Bankaccount Number')}}
                {{Form::text('bancaccount_nr', $rentable->bankaccount_nr, ['class' => 'form-control', 'placeholer' => 'Bankaccount number', 'readonly']) }}
            </div>
            @endif
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', $rentable->description, ['class' => 'form-control', 'placeholer' => 'Description', 'readonly']) }}
            </div>
            <a href="{{ url('/createlease/' . $rentable->id ) }}" class="btn btn-sm btn-primary">Rent</a>
            <a href="javascript:history.back()" class="btn btn-sm btn-primary">Back</a>
            {!! Form::close() !!}
            @if ($rentable->user_id === Auth::id() && count($rentable->leases) === 0)
            <div class="parkit-delete-button">
                {!! Form::open(['action' => ['RentableController@destroy', $rentable], 'method' => 'POST']) !!}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
