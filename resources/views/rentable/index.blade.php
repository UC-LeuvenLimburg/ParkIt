@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Places</h1>

    @if (count($rentables) > 0)
    <table class="table table-dark table-hover">
        <thead class="table-primary">
            <tr>
                @if (Auth::user()->role==="admin")
                <th scope="col">user</th>
                @endif
                <th scope="col">Adress</th>
                <th scope="col">Postal code</th>
                <th scope="col">Date of hire</th>
                <th scope="col">Start time</th>
                <th scope="col">End time</th>
                @if (Auth::user()->role==="user")
                <th scope="col">Price/h</th>
                @endif
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentables as $rentable)
            <tr>
                @if (Auth::user()->role==="admin")
                <td>{{ $rentable->user->name}}</td>
                @endif
                <td>{{ $rentable->adress}}</td>
                <td>{{ $rentable->postal_code}}</td>
                <td>{{ $rentable->date_of_hire}}</td>
                <td>{{ $rentable->start_time}}</td>
                <td>{{ $rentable->end_time}}</td>
                @if (Auth::user()->role==="user")
                <td>{{ $rentable->price}}</td>
                @endif
                <td>
                    <a class="btn btn-info btn-sm" href='/rentables/{{ $rentable->id }}'>Show</a>
                    @if (Auth::user()->role==="admin")
                    <a class="btn btn-info btn-sm btn-warning" href='/rentables/{{ $rentable->id }}/edit'>Edit</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="parkit-paginator">
        {{ $rentables->links() }}
        <div class="filler"></div>
        <a href="{{ route('rentables.create') }}" class="btn btn-sm btn-primary">Add New</a>
    </div>
    @else
    <p>No places found.</p>
    <a href="{{ route('rentables.create') }}" class="btn btn-sm btn-primary">Add New</a>
    @endif
</div>
@endsection
