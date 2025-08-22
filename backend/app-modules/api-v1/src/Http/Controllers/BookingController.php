<?php

namespace Modules\ApiV1\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Modules\ApiV1\Http\Requests\BookingStoreRequest;
use Modules\ApiV1\Http\Resources\BookingResource;

class BookingController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bookings = $request->user()->bookings()
            ->with('package:id,title,slug')
            ->orderBy('id', 'desc')->paginate(9);

        return BookingResource::collection($bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingStoreRequest $request)
    {
        $package = Package::find($request['package_id']);
        $request->user()->bookings()->create([
            'package_id' => $package->id,
            'travel_date' => $request['travel_date'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'quantity' => $request['quantity'],
            'total' => $package->priced() ?
            $package->priced() * $request['quantity'] :
            $package->price * $request['quantity'],
        ]);

        return response()->json(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
