@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
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
                    @if (Auth::user()->role==="admin")
                    {{Form::text('adress', $rentable->adress, ['class' => 'form-control', 'placeholer' => 'Adress', 'required']) }}
                    @else
                    {{Form::text('adress', $rentable->adress, ['class' => 'form-control', 'placeholer' => 'Adress', 'required','readonly']) }}
                    @endif
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('postal_code', 'Postal code')}}
                    @if (Auth::user()->role==="admin")
                    {{Form::text('postal_code', $rentable->postal_code, ['class' => 'form-control', 'placeholer' => 'PostalCode', 'required']) }}
                    @else
                    {{Form::text('postal_code', $rentable->postal_code, ['class' => 'form-control', 'placeholer' => 'PostalCode', 'required','readonly']) }}
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    {{Form::label('date_of_hire', 'Date')}}
                    @if (Auth::user()->role==="admin")
                    {{Form::date('date_of_hire', $rentable->date_of_hire, ['class' => 'form-control', 'placeholer' => 'Date', 'required']) }}
                    @else
                    {{Form::date('date_of_hire', $rentable->date_of_hire, ['class' => 'form-control', 'placeholer' => 'Date', 'required','readonly']) }}
                    @endif
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('start_time', 'Start Time')}}
                    @if (Auth::user()->role==="admin")
                    {{Form::time('start_time', date("H:i", strtotime($rentable->start_time)), ['class' => 'form-control', 'placeholer' => 'Start Time', 'required']) }}
                    @else
                    {{Form::time('start_time', date("H:i", strtotime($rentable->start_time)), ['class' => 'form-control', 'placeholer' => 'Start Time', 'required','readonly']) }}
                    @endif
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('end_time', 'End Time')}}
                    @if (Auth::user()->role==="admin")
                    {{Form::time('end_time', date("H:i", strtotime($rentable->end_time)), ['class' => 'form-control', 'placeholer' => 'End Time', 'required']) }}
                    @else
                    {{Form::time('end_time', date("H:i", strtotime($rentable->end_time)), ['class' => 'form-control', 'placeholer' => 'End Time', 'required','readonly']) }}
                    @endif
                </div>
            </div>
            <div class="form-group">
                {{Form::label('price', 'Price/h')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&euro;</span>
                    </div>
                    @if (Auth::user()->role==="admin")
                    {{Form::number('price', number_format($rentable->price, 2, '.', ''), ['class' => 'form-control', 'placeholer' => 'Price', 'step' => '.01', 'required']) }}
                    @else
                    {{Form::number('price', number_format($rentable->price, 2, '.', ''), ['class' => 'form-control', 'placeholer' => 'Price', 'step' => '.01', 'required','readonly']) }}
                    @endif
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
            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
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
