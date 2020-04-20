@extends('layouts.app')

@section('content')
<div class="container">


    <h1>Leases</h1>

    <a href="{{ route('leases.create') }}" class="btn btn-sm btn-primary">Add New</a>
    @if (count($leases) > 0)
    <table class="table table-dark table-hover">
        <thead class="table-primary">
            <tr>
                <th scope="col">Lease</th>
                <th scope="col">Date</th>
                <th scope="col">Start time</th>
                <th scope="col">End time</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leases as $lease)
            <tr>
                <td>{{$lease->rentable->adress}}</td>
                <td>{{$lease->rentable->date_of_hire}}</td>
                <td>{{$lease->start_time}}</td>
                <td>{{$lease->end_time}}</td>
                <td>
                    <a class="btn btn-info btn-sm" href='/leases/{{ $lease->id }}'>Show</a>
                    <a class="btn btn-info btn-sm btn-warning" href='/leases/{{ $lease->id }}/edit'>Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $leases->links() }}
    @else
    <p>No leases found.</p>
    @endif
</div>
@endsection
