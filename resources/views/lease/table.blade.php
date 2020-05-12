<h3>Current Leases</h3>
<table class="table table-dark table-hover">
    <thead class="table-primary">
        <tr>
            <th scope="col">Lease</th>
            <th scope="col">Date</th>
            <th scope="col">Start time</th>
            <th scope="col">End time</th>
            <th scope="col" id="Hide-width-576">Phone Number</th>
            <th scope="col" id="Hide-width-576">License Plate</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leases as $lease)
        <tr>
            <td>{{$lease->rentable->adress}}</td>
            <td>{{date("d-m-Y", strtotime($lease->rentable->date_of_hire))}}</td>
            <td>{{date("H:i", strtotime($lease->start_time))}}</td>
            <td>{{date("H:i", strtotime($lease->end_time))}}</td>
            <td id="Hide-width-576">{{$lease->phone_nr}}</td>
            <td id="Hide-width-576">{{$lease->license_plate}}</td>
            <td>
                <a class="btn btn-info btn-sm" href='/leases/{{ $lease->id }}'>Show</a>
                @if (Auth::user()->role==="admin" || $lease->user_id == Auth::id())
                <a class="btn btn-sm btn-warning" href='/leases/{{ $lease->id }}/edit'>Edit</a>
                @endif
                @if ( $lease->payed_at === NULL && $lease->user_id == Auth::id())
                <a class="btn btn-danger btn-sm" href='/pay/{{$lease->id}}/'>Pay</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
