@extends('layouts.app')

@section('content')
    <h1>All Users</h1>
    @if (count($users) > 0)
        <table class="table table-dark table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col"></th>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No Users Found</p>
    @endif
@endsection