<?php

namespace App\Http\Controllers;

use App\Models\Lease;
use App\Models\Rentable;
use App\Repositories\Interfaces\ILeaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaseController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leases =  $this->leaseRepo->getLeases();
        return view('lease.index', compact('leases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $rentable = Rentable::find(1);
        return view('lease.create')->with(compact('user', 'rentable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newLease = $this->leaseRepo->addLease($request->all());
        return redirect('/leases/' . $newLease->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lease  $lease
     * @return \Illuminate\Http\Response
     */
    public function show(Lease $lease)
    {
        return view('lease.show', compact('lease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lease  $lease
     * @return \Illuminate\Http\Response
     */
    public function edit(Lease $lease)
    {
        return view('lease.edit', compact('lease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lease  $lease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lease $lease)
    {
        $this->leaseRepo->updateLease($lease);
        return redirect('/leases/' . $lease->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lease  $lease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lease $lease)
    {
        //
    }
}
