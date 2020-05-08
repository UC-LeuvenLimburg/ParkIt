@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h1>Create Lease</h1>
            <div class="Only-show-on-small-screen">
                @if ($rentable !== null)
                @include('lease.currentleases',$rentable)
                @endif
            </div>
            @if (Auth::user()->role === "admin" && $rentable === null)
            {!! Form::open(['route' => 'leases.store']) !!}
            @else
            {!! Form::open(['url' => '/createlease', 'method' => 'POST'])!!}
            @endif

            @if (Auth::user()->role === "admin" && $rentable === null)
            <div class="form-group">
                {{Form::label('user_id', 'User Email')}}
                <user-autocomplete />
            </div>
            <div class="form-group">
                {{Form::label('rentable_id', 'Place')}}
                <rentable-form />
            </div>
            @else
            {{Form::hidden('user_id', $user_id, ['hidden', 'required'])}}
            {{Form::hidden('rentable_id', $rentable->id, ['hidden', 'required'])}}
            @endif

            @if ($rentable !== null)
            <div class="form-group">
                {{Form::label('adress', 'Adress')}}
                {{Form::text('adress', $rentable->adress, ['class' => 'form-control', 'placeholer' => 'Adress', 'readonly']) }}
            </div>
            @endif
            <div class="form-row">
                @if ($rentable !== null)
                <div class="form-group col-md-4">
                    {{Form::label('date', 'Date')}}
                    {{Form::date('date', $rentable->date_of_hire, ['class' => 'form-control', 'placeholer' => 'Date', 'readonly']) }}
                </div>
                @endif
                <div class="form-group col-md-4">
                    {{Form::label('start_time', 'Start Time')}}
                    {{Form::time('start_time', '', ['class' => 'form-control', 'placeholer' => 'Start Time', 'required']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('end_time', 'End Time')}}
                    {{Form::time('end_time', '', ['class' => 'form-control', 'placeholer' => 'End Time', 'required']) }}
                </div>
            </div>
            @if ($rentable !== null)
            <div class="form-group">
                {{Form::label('price', 'Price/h')}}
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">&euro;</span>
                    </div>
                    {{Form::text('price', number_format($rentable->price, 2, '.', ''), ['class' => 'form-control', 'placeholer' => 'Date', 'readonly']) }}
                </div>
            </div>
            @endif
            <div class="form-row ">
                <div class="form-group col-md-6">
                    {{Form::label('phone_nr', 'Phone number')}}
                    {{Form::text('phone_nr', '', ['class' => 'form-control', 'placeholer' => 'phone_nr', 'required']) }}
                </div>
                <div class="form-group col-md-6">
                    {{Form::label('license_plate', 'License plate')}}
                    {{Form::text('license_plate', '', ['class' => 'form-control', 'placeholer' => 'license_plate', 'required']) }}
                </div>
            </div>
            @if (Auth::user()->role === "admin" && $rentable === null)
            {{Form::submit('Save', [ 'class' => 'btn btn-primary'])}}
            @else
            {{Form::submit('Pay', [ 'class' => 'btn btn-primary'])}}
            @endif
            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
            {!! Form::close() !!}
        </div>
        <div class="col-sm-2" id="Hide-width-991">
        </div>
        <div class="col-sm-4" id="Hide-width-991">
            @if ($rentable !== null)
            <div class="col-xl mt-4">
                @include('lease.currentleases', $rentable)
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
