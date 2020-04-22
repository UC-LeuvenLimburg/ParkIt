@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>Create User</h1>
            {!! Form::open(['route' => 'users.store']) !!}
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', '', ['class' => 'form-control', 'placeholer' => 'Name']) }}
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::email('email', '', ['class' => 'form-control', 'placeholer' => 'email@example.com']) }}
            </div>
            <div class="form-group">
                {{Form::label('role', 'Role')}}
                {{Form::text('role', '', ['class' => 'form-control', 'placeholer' => 'Role']) }}
            </div>
            <div class="form-group">
                {{Form::label('password', 'Password')}}
                {{Form::password('password', ['class' => 'form-control', 'placeholer' => 'Password']) }}
            </div>
            {{Form::submit('Save', [ 'class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
