<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Offence;
use Illuminate\Http\Request;

class OffenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // $driver = Auth::user();
    // // dd($driver->licencenumber); // Dump and die to check the driver's licencenumber

    // // Retrieve the offenses associated with the driver
    // $offences = $driver->offences;
    // // $offences = $driver->offences()->paginate(10);

    $driver = Auth::user();

    $searchQuery = $request->input('search');

    $offences = $driver->offences()
        ->where('OffenceCommited', 'like', '%' . $searchQuery . '%')
        ->get();
    


    return view('offences.index', compact('offences'));
}
public function search(Request $request)
{
    $driver = Auth::user();
    $searchQuery = $request->input('PlaceOfOffence');
    $offenseType = $request->input('TicketId');

    $query = $driver->offences();

    if ($searchQuery) {
        $query->where('PlaceOfOffence', 'like', '%' . $searchQuery . '%');
    }

    if ($offenseType) {
        $query->where('TicketId', 'like', '%' . $offenseType . '%');
    }

    $offences = $query->get();

    return view('offences.index', compact('offences'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
