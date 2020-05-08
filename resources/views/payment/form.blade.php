@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-6" id="Change-width-991">
            <h1>Payment</h1>
            {!! Form::open(['url' => '/pay', 'method' => 'POST'])!!}
            {{Form::hidden('lease_id', $lease->id, ['hidden'])}}
            {{Form::hidden('user_id', $lease->user_id, ['hidden'])}}
            <div class="form-group">
                {{Form::label('name', 'Owner')}}
                {{Form::text('name',$lease->rentable->user->name, ['class' => 'form-control', 'placeholer' => 'name', 'readonly']) }}
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    {{Form::label('adress', 'Adress')}}
                    {{Form::text('adress', $lease->rentable->adress, ['class' => 'form-control', 'placeholer' => 'Adress', 'readonly']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('postal_code', 'Postal code')}}
                    {{Form::text('postal_code', $lease->rentable->postal_code, ['class' => 'form-control', 'placeholer' => 'PostalCode', 'readonly']) }}
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-md-4">
                    {{Form::label('date', 'Date')}}
                    {{Form::date('date', $lease->rentable->date_of_hire, ['class' => 'form-control', 'placeholer' => 'Date', 'readonly']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('start_time', 'Start Time')}}
                    {{Form::time('start_time', $lease->start_time, ['class' => 'form-control', 'placeholer' => 'Start Time', 'readonly']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('end_time', 'End Time')}}
                    {{Form::time('end_time', $lease->end_time, ['class' => 'form-control', 'placeholer' => 'End Time', 'readonly']) }}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('price', 'Total Price (Tax included)')}}
                {{Form::text('price', number_format($totalPrice, 2, '.', ''), ['class' => 'form-control', 'placeholer' => 'Price', 'readonly']) }}
            </div>
            <p>Select a payment method</p>
            <div class="form-group cc-selector" id="No-font-size">
                <input type="radio" id="mastercard" name="payment_method" value="mastercard" required>
                <label class="drinkcard-cc mastercard" for="mastercard"></label>
                <input type="radio" id="visa" name="payment_method" value="visa" required>
                <label class="drinkcard-cc visa" for="visa"></label>
                <input type="radio" id="paypal" name="payment_method" value="paypal" required>
                <label class="drinkcard-cc paypal" for="paypal"></label>
                <input type="radio" id="americanexpress" name="payment_method" value="americanexpress" required>
                <label class="drinkcard-cc americanexpress" for="americanexpress"></label>
                <input type="radio" id="maestro" name="payment_method" value="maestro" required>
                <label class="drinkcard-cc maestro" for="maestro"></label>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="user_agreement" id="user_agreement"
                        required>
                    <label class="custom-control-label" for="user_agreement">
                        Do you agree with our terms of service?
                    </label>
                </div>
            </div>
            {{Form::submit('Pay', [ 'class' => 'btn btn-primary'])}}
            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
