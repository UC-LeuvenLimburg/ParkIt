<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaseRequest;
use App\Http\Requests\UpdateLeaseRequest;
use App\Models\Lease;
use App\Repositories\Interfaces\ILeaseRepository;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Support\Facades\Auth;

class APILeaseController extends Controller
{
    private $leaseRepo;

    public function __construct(ILeaseRepository $leaseRepo)
    {
        $this->authorizeResource(Lease::class, 'lease');
        $this->leaseRepo = $leaseRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return \Illuminate\Http\Response
     */
    public function index(ModelFilters $query)
    {
        $leases =  $this->leaseRepo->getLeases($query);
        return response()->json($leases);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return \Illuminate\Http\Response
     */
    public function indexall(ModelFilters $query)
    {
        $this->authorize('viewAny', Lease::class);
        $leases =  $this->leaseRepo->getAllLeases($query);
        return response()->json($leases);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreLeaseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeaseRequest $request)
    {
        $newLease = $this->leaseRepo->addLease($request->all());
        return response()->json($newLease);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lease $lease
     * @return \Illuminate\Http\Response
     */
    public function show(Lease $lease)
    {
        return response()->json($lease);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateLeaseRequest $request
     * @param  \App\Models\Lease $lease
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeaseRequest $request, Lease $lease)
    {
        $updatedLease = $this->leaseRepo->updateLease($lease->id, $request->all());
        return response()->json($updatedLease);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lease $lease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lease $lease)
    {
        $this->leaseRepo->deleteLease($lease->id);
        return response('success', 200);
    }

    /**
     * Display my leases
     *
     * @return \Illuminate\Http\Response
     */
    public function myleases()
    {
        $this->authorize('viewAny', Lease::class);
        $leases = $this->leaseRepo->getUserLeases(Auth::id());
        return response()->json($leases);
    }
}
