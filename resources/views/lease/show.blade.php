@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h1>Lease details</h1>
            {!! Form::model($lease) !!}
            <div class="form-group">
                {{Form::label('adress', 'Adress')}}
                {{Form::text('adress', $lease->rentable->adress, ['class' => 'form-control', 'placeholer' => 'Adress', 'readonly']) }}
            </div>
            <div class="form-row ">
                <div class="form-group col-md-4">
                    {{Form::label('date', 'Date')}}
                    {{Form::date('date', $lease->rentable->date_of_hire, ['class' => 'form-control', 'placeholer' => 'Date', 'readonly']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('start_time', 'Start Time')}}
                    {{Form::time('start_time', date("H:i", strtotime($lease->start_time)), ['class' => 'form-control', 'placeholer' => 'Start Time', 'readonly']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('end_time', 'End Time')}}
                    {{Form::time('end_time', date("H:i", strtotime($lease->end_time)), ['class' => 'form-control', 'placeholer' => 'End Time', 'readonly']) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('price', 'Total Price')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&euro;</span>
                    </div>
                    {{Form::text('price', number_format($totalPrice, 2, '.', ''), ['class' => 'form-control', 'placeholer' => 'total price', 'readonly']) }}
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-md-6">
                    {{Form::label('phone_nr', 'Phone number')}}
                    {{Form::text('phone_nr', $lease->phone_nr, ['class' => 'form-control', 'placeholer' => 'phone_nr', 'readonly']) }}
                </div>
                <div class="form-group col-md-6">
                    {{Form::label('license_plate', 'License plate')}}
                    {{Form::text('license_plate', $lease->license_plate, ['class' => 'form-control', 'placeholer' => 'license_plate', 'readonly']) }}
                </div>
            </div>
            {!! Form::close() !!}
            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection
