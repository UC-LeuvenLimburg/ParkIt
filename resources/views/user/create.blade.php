@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>Create User</h1>
            {!! Form::open(['route' => 'users.store']) !!}
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholer' => 'Name', 'required']) }}
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::email('email', '', ['class' => 'form-control', 'placeholer' => 'email@example.com', 'required']) }}
            </div>
            <div class="form-row ">
                <div class="form-group col-md-4">
                    {{Form::label('role', 'Role')}}
                    {{Form::text('role', '', ['class' => 'form-control', 'placeholer' => 'Role', 'required']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('password', 'Password')}}
                    {{Form::password('password', ['class' => 'form-control', 'placeholer' => 'Password', 'required']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('confirm_password', 'Confirm Password')}}
                    {{Form::password('confirm_password', ['class' => 'form-control', 'placeholer' => 'Password', 'required']) }}
                </div>
            </div>
            {{Form::submit('Save', [ 'class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
