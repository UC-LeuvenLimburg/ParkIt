@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <h1>User details</h1>
            {!! Form::model($user) !!}
            <div class="form-group">
                {{Form::label('name', 'Name')}}
                {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholer' => 'Name', 'disabled']) }}
            </div>
            <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::email('email', $user->email, ['class' => 'form-control', 'placeholer' => 'Email', 'disabled']) }}
            </div>
            <div class="form-row ">
                <div class="form-group col-md-4">
                    {{Form::label('role', 'Role')}}
                    {{Form::text('role', $user->role, ['class' => 'form-control', 'placeholer' => 'Role', 'disabled']) }}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('email_verified_at', 'Email verified at')}}
                    @if ($user->email_verified_at == null)
                    {{Form::text('email_verified_at', 'Email has not been verified', ['class' => 'form-control', 'placeholer' => 'Email verified at', 'disabled']) }}
                    @else
                    {{Form::date('email_verified_at', $user->email_verified_at, ['class' => 'form-control', 'placeholer' => 'Email verified at', 'disabled']) }}
                    @endif

                </div>
                <div class="form-group col-md-4">
                    {{Form::label('created_at', 'Created at')}}
                    {{Form::date('created_at', $user->created_at, ['class' => 'form-control', 'placeholer' => 'Created at', 'disabled']) }}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
