@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h1>Edit Lease</h1>
            {!! Form::model($lease, ['route' => ['leases.update', $lease], 'method' => 'PUT']) !!}
            <div class="form-group">
                {{Form::label('adress', 'Adress')}}
                {{Form::text('adress', $lease->rentable->adress, ['class' => 'form-control', 'placeholer' => 'Adress', 'readonly']) }}
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    {{Form::label('date', 'Date')}}
                    {{Form::date('date', $lease->rentable->date_of_hire, ['class' => 'form-control', 'placeholer' => 'Date', 'readonly']) }}
                </div>
                {{Form::hidden('lease_id', $lease->id, ['hidden', 'required'])}}
                {{Form::hidden('user_id', $lease->user_id, ['hidden', 'required'])}}
                {{Form::hidden('rentable_id', $lease->rentable->id, ['hidden', 'required'])}}
                @if (Auth::user()->role==="admin")
                <div class="form-group col-md-4">
                    {{Form::label('start_time', 'Start Time')}}
                    {{Form::time('start_time', date("H:i", strtotime($lease->start_time)), ['class' => 'form-control', 'placeholer' => 'Start Time', 'required']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('end_time', 'End Time')}}
                    {{Form::time('end_time', date("H:i", strtotime($lease->end_time)), ['class' => 'form-control', 'placeholer' => 'End Time', 'required']) }}
                </div>
                @else
                <div class="form-group col-md-4">
                    {{Form::label('start_time', 'Start Time')}}
                    {{Form::time('start_time', date("H:i", strtotime($lease->start_time)), ['class' => 'form-control', 'placeholer' => 'Start Time', 'required','readonly']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('end_time', 'End Time')}}
                    {{Form::time('end_time', date("H:i", strtotime($lease->end_time)), ['class' => 'form-control', 'placeholer' => 'End Time', 'required', 'readonly']) }}
                </div>
                @endif
            </div>
            <div class="form-group">
                {{Form::label('price', 'Price/h')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&euro;</span>
                    </div>
                    {{Form::text('price', number_format($lease->rentable->price, 2, '.', ''), ['class' => 'form-control', 'placeholer' => 'Date', 'readonly']) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('phone_nr', 'Phone number')}}
                {{Form::text('phone_nr', $lease->phone_nr, ['class' => 'form-control', 'placeholer' => 'phone_nr', 'required']) }}
            </div>
            <div class="form-group">
                {{Form::label('license_plate', 'License plate')}}
                {{Form::text('license_plate', $lease->license_plate, ['class' => 'form-control', 'placeholer' => 'license_plate', 'required']) }}
            </div>
            {{Form::submit('Save', [ 'class' => 'btn btn-primary'])}}
            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
            {!! Form::close() !!}
            <div class="parkit-delete-button">
                {!! Form::open(['action' => ['LeaseController@destroy', $lease], 'method' => 'POST']) !!}
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
