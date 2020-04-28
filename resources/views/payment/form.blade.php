@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>Payment form</h1>
            {!! Form::open(['url' => '/pay']) !!}
            <div class="form-group">
                {{Form::label('price', 'Price')}}
                {{Form::text('price', $totalPrice, ['class' => 'form-control', 'placeholer' => 'Price', 'disabled']) }}
            </div>
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name',$lease->rentable->user->name, ['class' => 'form-control', 'placeholer' => 'name', 'disabled']) }}
            </div>
            <div class="form-group">
                {{Form::label('bankaccount_nr', 'Bankaccount Number')}}
                {{Form::text('bankaccount_nr', $lease->rentable->bankaccount_nr, ['class' => 'form-control', 'placeholer' => 'Bankaccount number', 'required'])}}
            </div>
            {{Form::submit('Pay', [ 'class' => 'btn btn-primary'])}}
            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
