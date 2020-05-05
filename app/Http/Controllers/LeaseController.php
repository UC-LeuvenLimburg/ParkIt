<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Requests\StoreLeaseRequest;
use App\Http\Requests\UpdateLeaseRequest;
use App\Models\Lease;
use App\Models\Rentable;
use App\Repositories\Interfaces\ILeaseRepository;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use App\Repositories\Interfaces\IRentableRepository;
use Illuminate\Support\Facades\Auth;

class LeaseController extends Controller
{
    private $leaseRepo;
    private $rentableRepo;

    public function __construct(ILeaseRepository $leaseRepo, IRentableRepository $rentableRepo)
    {
        $this->authorizeResource(Lease::class, 'lease');
        $this->leaseRepo = $leaseRepo;
        $this->rentableRepo = $rentableRepo;
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
        return view('lease.index', compact('leases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        $rentable = null;
        return view('lease.create')->with(compact('user_id', 'rentable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreLeaseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeaseRequest $request)
    {
        $newLease = $this->leaseRepo->addLease($request->validated());
        return redirect('/leases/' . $newLease->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lease $lease
     * @return \Illuminate\Http\Response
     */
    public function show(Lease $lease)
    {
        return view('lease.show', compact('lease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lease $lease
     * @return \Illuminate\Http\Response
     */
    public function edit(Lease $lease)
    {
        return view('lease.edit', compact('lease'));
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
        $this->leaseRepo->updateLease($lease->id, $request->validated());
        return redirect('/leases/' . $lease->id);
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
        return redirect('/leases')->with('success', 'Lease Removed');
    }

    /**
     * Display my leases
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return \Illuminate\Http\Response
     */
    public function myleases(ModelFilters $query)
    {
        $this->authorize('viewAny', Lease::class);
        $leases = $this->leaseRepo->getUserLeases(Auth::id(), $query);
        return view('lease.index', compact('leases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createlease(int $id)
    {
        $user_id = Auth::id();
        $rentable = $this->rentableRepo->getRentable($id);
        return view('lease.create')->with(compact('user_id', 'rentable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreLeaseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storelease(StoreLeaseRequest $request)
    {
        $newLease = $this->leaseRepo->addLease($request->validated());
        return redirect('/pay/' . $newLease->id);
    }

    /**
     * Show the payform.
     *
     * @return \Illuminate\Http\Response
     */
    public function pay(int $id)
    {
        $totalTax = 0.15;
        $lease = $this->leaseRepo->getLease($id);
        $this->authorize('update', $lease);
        $totalTimeInHours = $lease->rentTimeInMinutes() / 60;
        $totalPrice = ($totalTimeInHours * $lease->rentable->price) + $totalTax;
        return view('payment.form')->with(compact('lease', 'totalPrice'));
    }

    /**
     * process the payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function processpayment(PaymentRequest $request)
    {
        $id = $request->validated()['lease_id'];
        $this->leaseRepo->updateLease($id, ['payed_at' => now()]);
        return view('payment.redirect');
    }
}
