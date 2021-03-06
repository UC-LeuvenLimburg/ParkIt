<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRentableRequest;
use App\Http\Requests\UpdateRentableRequest;
use App\Models\Rentable;
use App\Repositories\Interfaces\IRentableRepository;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Support\Facades\Auth;

class RentableController extends Controller
{
    private $rentableRepo;

    public function __construct(IRentableRepository $rentableRepo)
    {
        $this->authorizeResource(Rentable::class, 'rentable');
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
        $rentables =  $this->rentableRepo->getRentables($query);
        return view('rentable.index', compact('rentables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rentable.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreRentableRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRentableRequest $request)
    {
        $newRentable = $this->rentableRepo->addRentable($request->all());
        if (Auth::user()->role === "admin") {
            return redirect('/rentables/');
        } else {
            return redirect('/myplaces');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rentable $rentable
     * @return \Illuminate\Http\Response
     */
    public function show(Rentable $rentable)
    {
        return view('rentable.show', compact('rentable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rentable $rentable
     * @return \Illuminate\Http\Response
     */
    public function edit(Rentable $rentable)
    {
        return view('rentable.edit', compact('rentable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateRentableRequest $request
     * @param  \App\Models\Rentable $rentable
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRentableRequest $request, Rentable $rentable)
    {
        $this->rentableRepo->updateRentable($rentable->id, $request->validated());
        return redirect('/rentables/' . $rentable->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rentable $rentable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rentable $rentable)
    {
        $this->rentableRepo->deleteRentable($rentable->id);
        if (Auth::user()->role === "admin") {
            return redirect('/rentables')->with('success', 'Place Removed');
        } else {
            return redirect('/myplaces')->with('success', 'Place Removed');
        }
    }

    /**
     * Display my places
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return \Illuminate\Http\Response
     */
    public function myplaces(ModelFilters $query)
    {
        $this->authorize('viewAny', Rentable::class);
        $rentables = $this->rentableRepo->getUserRentables(Auth::id(), $query);
        return view('rentable.index', compact('rentables'));
    }
}
