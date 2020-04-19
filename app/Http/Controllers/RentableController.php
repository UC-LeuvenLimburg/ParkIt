<?php

namespace App\Http\Controllers;

use App\Models\Rentable;
use App\Repositories\Interfaces\IRentableRepository;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentables =  $this->rentableRepo->getRentables();
        return view('rentable.index', compact('rentables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rentable  $rentable
     * @return \Illuminate\Http\Response
     */
    public function show(Rentable $rentable)
    {
        return view('rentable.show', compact('rentable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rentable  $rentable
     * @return \Illuminate\Http\Response
     */
    public function edit(Rentable $rentable)
    {
        return view('rentable.edit', compact('rentable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rentable  $rentable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rentable $rentable)
    {
        $this->rentableRepo->updateRentable($rentable, $request->all());
        return redirect('/rentables/' . $rentable->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rentable  $rentable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rentable $rentable)
    {
        $this->rentableRepo->deleteRentable($rentable->id);
        return redirect('/rentables')->with('success', 'Place Removed');
    }
}
