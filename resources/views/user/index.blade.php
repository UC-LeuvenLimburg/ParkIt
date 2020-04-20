@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Users</h1>

    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">Add New</a>
    @if (count($users) > 0)
    <table class="table table-dark table-hover">
        <thead class="table-primary">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href='/users/{{ $user->id }}'>Show</a>
                    <a class="btn btn-info btn-sm btn-warning" href='/users/{{ $user->id }}/edit'>Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
    @else
    <p>No users found.</p>
    @endif
</div>
@endsection
