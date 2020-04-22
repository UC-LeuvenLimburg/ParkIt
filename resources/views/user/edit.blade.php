@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <h1>User details</h1>
            {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'PUT']) !!}
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholer' => 'Name']) }}
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::email('email', $user->email, ['class' => 'form-control', 'placeholer' => 'Email']) }}
            </div>
            <div class="form-group">
                {{Form::label('role', 'Role')}}
                {{Form::text('role', $user->role, ['class' => 'form-control', 'placeholer' => 'Role']) }}
            </div>
            <div class="form-group">
                {{Form::label('email_verified_at', 'Email verified at')}}
                {{Form::date('email_verified_at', $user->email_verified_at, ['class' => 'form-control', 'placeholer' => 'Email verified at', 'disabled']) }}
            </div>
            <div class="form-group">
                {{Form::label('created_at', 'Created at')}}
                {{Form::date('created_at', $user->created_at, ['class' => 'form-control', 'placeholer' => 'Created at', 'disabled']) }}
            </div>
            {{Form::submit('Save', [ 'class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
            <div class="parkit-delete-button">
                {!! Form::open(['action' => ['UserController@destroy', $user], 'method' => 'POST']) !!}
                @if (Auth::user()->role==="admin" && $user->name!=="admin" && $user!==Auth::User())
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
