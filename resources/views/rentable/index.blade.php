@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Places</h1>
    @if (count($rentables) > 0)
    <table class="table table-dark table-hover">
        <thead class="table-primary">
            <tr>
                <th scope="col">user</th>
                <th scope="col">Adress</th>
                <th scope="col">Postal code</th>
                <th scope="col">Date of hire</th>
                <th scope="col">Start time</th>
                <th scope="col">End time</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentables as $rentable)
            <tr>
                <td>{{ $rentable->user->name}}</td>
                <td>{{ $rentable->adress}}</td>
                <td>{{ $rentable->postal_code}}</td>
                <td>{{ $rentable->date_of_hire}}</td>
                <td>{{ $rentable->start_time_rp}}</td>
                <td>{{ $rentable->end_time_rp}}</td>
                <td>
                    <a class="btn btn-info btn-sm" href='/rentables/{{ $rentable->id }}'>Show</a>
                    <a class="btn btn-info btn-sm btn-warning" href='/rentables/{{ $rentable->id }}/edit'>Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $rentables->links() }}
    @else
    <p>No places found.</p>
    @endif
</div>
@endsection
