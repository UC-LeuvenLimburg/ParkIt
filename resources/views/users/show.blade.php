@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Show User</h1>
    <div class="card border-primary">
        <h4 class="card-header">User Id: {{ $user->id }}</h4>
        <div class="card-body">
            Name: {{ $user->name }}<br>
            Email: {{ $user->email }}<br>
            Role: {{ $user->role }}<br>
            Email verified at: {{ $user->email_verified_at }}<br>
            Created at: {{ $user->created_at }}
            @if ($user->name != 'admin')
                {!! Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'POST']) !!}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {!! Form::close() !!}
            @endif
        </div>
    </div>
</div>
@endsection