@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>User details</h1>
           {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'PUT']) !!}
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholer' => 'Name', 'disabled']) }}
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::email('email', $user->email, ['class' => 'form-control', 'placeholer' => 'Email', 'disabled']) }}
            </div>
            <div class="form-group">
                {{Form::label('password', 'New Password')}}
                {{Form::password('password', ['class' => 'form-control', 'placeholer' => 'Password']) }}
            </div>
            {{Form::submit('change password', [ 'class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
