@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Show User</h1>
    <div class="card border-primary">
        <h4 class="card-header">User: {{ $user->name }}</h4>
        <div class="card-body">
            Email: {{ $user->email }}
            Role: {{ $user->role }}
        </div>
    </div>
</div>
@endsection