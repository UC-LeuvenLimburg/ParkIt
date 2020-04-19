@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Places</h1>
    @if (count($rentables) > 0)
    <table class="table table-dark table-hover">
        <thead class="table-primary">
            <tr>
                <th scope="col">user id</th>
                <th scope="col">adress</th>
                <th scope="col">postal code</th>
                <th scope="col"> date of hire</th>
                <th scope="col"> start time</th>
                <th scope="col"> end time</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentables as $rentable)
            <tr>
                <td>{{ $rentable->user_id}}</td>
                <td>{{ $rentable->adress}}</td>
                <td>{{ $rentable->postal_code}}</td>
                <td>{{ $rentable->date_of_hire}}</td>
                <td>{{ $rentable->start_time_rp}}</td>
                <td>{{ $rentable->end_time_rp}}</td>
                <td>
                    <a class="btn btn-info btn-sm" href='/rentable/edit{{ $rentable->id }}'>edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $rentables->links() }}
    @else
    <p>No Users Found</p>
    @endif
</div>
@endsection