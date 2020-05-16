@extends('layouts.app')

@section('content')
@if(Auth::user()->role!=="admin" && Request::path() === "rentables")

<head>
    <meta http-equiv="refresh" content="0; URL=/rent" />
</head>
@endif
<div class="container">

    <h1>Places</h1>

    @if(Request::path() === "rent")
    @include('include.map')
    @endif

    <div><br></div>
    @if(Request::path() === "rentables")
    <a href="{{ route('rentables.create') }}" class="btn btn-sm btn-primary">Add New</a>
    @endif

    <rentables-searchbar></rentables-searchbar>

    @if (count($rentables) > 0)
    <h3>Current Places</h3>
    <table class="table table-dark table-hover mt-4">
        <thead class="table-primary">
            <tr>
                @if (Auth::user()->role==="admin")
                <th scope="col" id="Hide-width-767">Email</th>
                @endif
                <th scope="col">Adress</th>
                <th scope="col" id="Hide-width-576">Postal code</th>
                <th scope="col">Date of hire</th>
                <th scope="col">Start time</th>
                <th scope="col">End time</th>
                @if (Auth::user()->role==="user")
                <th scope="col" id="Hide-width-576">Price/h</th>
                @endif
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentables as $rentable)
            <tr>
                @if (Auth::user()->role==="admin")
                <td  id="Hide-width-767">{{ $rentable->user->email}}</td>
                @endif
                <td>{{$rentable->adress}}</td>
                <td id="Hide-width-576">{{$rentable->postal_code}}</td>
                <td>{{date("d-m-Y", strtotime($rentable->date_of_hire))}}</td>
                <td>{{date("H:i", strtotime($rentable->start_time))}}</td>
                <td>{{date("H:i", strtotime($rentable->end_time))}}</td>
                @if (Auth::user()->role==="user")
                <td id="Hide-width-576">{{ $rentable->price}}</td>
                @endif
                <td>
                    <a class="btn btn-info btn-sm" href='/rentables/{{ $rentable->id }}'>Show</a>
                    @if (Auth::user()->role==="admin" || $rentable->user_id === Auth::id())
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
    </div>
    @else
    <p>No places found.</p>
    @endif
</div>
@endsection
