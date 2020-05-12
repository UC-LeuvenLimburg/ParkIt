@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Leases</h1>

    @if (Auth::user()->role==="admin")
    <a href="{{ route('leases.create') }}" class="btn btn-sm btn-primary">Add New</a>
    <div><br></div>
    @endif

    <leases-searchbar></leases-searchbar>

    @if (count($leases) > 0)
    @include('lease.table', $leases)
    <div class="parkit-paginator">
        {{ $leases->links() }}
        <div class="filler"></div>
    </div>
    @else
    <p>No leases found.</p>
    @endif
</div>
@endsection
