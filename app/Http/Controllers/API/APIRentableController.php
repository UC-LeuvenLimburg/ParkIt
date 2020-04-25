<?php

namespace App\Http\Controllers\API;

use App\Models\Rentable;
use App\Repositories\Interfaces\IRentableRepository;
use App\Http\Controllers\Controller;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Illuminate\Http\Request;

class APIRentableController extends Controller
{
    protected $rentableRepo;

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
        return response()->json($rentables);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \eloquentFilter\QueryFilter\ModelFilters\ModelFilters $query
     * @return \Illuminate\Http\Response
     */
    public function indexall(ModelFilters $query)
    {
        $this->authorize('viewAny', Rentable::class);
        $rentables = $this->rentableRepo->getAllRentables($query);
        return response()->json($rentables);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newRentable = $this->rentableRepo->addRentable($request->all());
        return response()->json($newRentable);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rentable $rentable
     * @return \Illuminate\Http\Response
     */
    public function show(Rentable $rentable)
    {
        return response()->json($rentable);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Rentable $rentable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rentable $rentable)
    {
        $updatedRentable = $this->rentableRepo->updateRentable($rentable->id, $request->all());
        return response()->json($updatedRentable);
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
        return response('success', 200);
    }
}
