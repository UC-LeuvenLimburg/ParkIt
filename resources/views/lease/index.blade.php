@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl">
            <div class="card">

                <div class="card-header">Leases</div>

                <div class="card-body">
                    <a href="{{ route('leases.create') }}" class="btn btn-sm btn-primary">Add New</a>
                    <br />
                    <br />

                    <table class="table">
                        <tr>
                            <th>Lease</th>
                            <th>Date</th>
                            <th>Start time</th>
                            <th>End time</th>
                        </tr>
                        @forelse ($leases as $lease)
                        <tr>
                            <td style="min-width: 250px">{{$lease->rentable->adress}}</td>
                            <td>{{$lease->rentable->date_of_hire}}</td>
                            <td>{{$lease->start_time}}</td>
                            <td>{{$lease->end_time}}</td>
                            <td><a href="{{ url('leases/'.$lease->id.'/edit') }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No leases found.</td>
                        </tr>
                        @endforelse
                    </table>
                    {{ $leases->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
