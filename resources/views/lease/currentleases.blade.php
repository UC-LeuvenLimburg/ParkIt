<br>
<br>
<div class="list-group">
    <li class="list-group-item list-group-item-action active">Available Time</li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        {{date("H:i", strtotime($rentable->start_time))}} &#8594; {{date("H:i", strtotime($rentable->end_time))}}
    </li>
</div>
<br>
@php($leases = $rentable->leases)
@if (count($leases) > 0)
<div class="list-group">
    <li class="list-group-item list-group-item-action active">Current Leases</li>
    @foreach ($leases as $lease)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        Rented from: {{date("H:i", strtotime($lease->start_time))}} &#8594; {{date("H:i", strtotime($lease->end_time))}}
    </li>
    @endforeach
</div>
<br>
@endif
