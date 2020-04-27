@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Leases</h1>

    @if (count($leases) > 0)
    @include('lease.table', $leases)
    <div class="parkit-paginator">
        {{ $leases->links() }}
        <div class="filler"></div>
        @if (Auth::user()->role==="admin")
        <a href="{{ route('leases.create') }}" class="btn btn-sm btn-primary">Add New</a>
        @endif
    </div>
    @else
    <p>No leases found.</p>
    @if (Auth::user()->role==="admin")
    <a href="{{ route('leases.create') }}" class="btn btn-sm btn-primary">Add New</a>
    @endif
    @endif
</div>
@endsection
