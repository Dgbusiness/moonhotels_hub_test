<?php

namespace App\Http\Controllers;

use App\Http\Pipes\HUBPipeline;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HUB extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    /**
     * Request for rooms availability.
     */
    public function search(Request $request): JsonResponse
    {
        $this->validate($request, [
            'hotelId' => 'required|integer',
            'checkIn' => 'required|date',
            'checkOut' => 'required|date|after:checkIn',
            'numberOfGuests' => 'required|integer|min:1',
            'numberOfRooms' => 'required|integer|min:1',
            'currency' => 'required|string|in:EUR'
        ]);

        $result = HUBPipeline::search($request);


        return $result;
    }
}
