<?php

namespace Modules\ApiV1\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Modules\ApiV1\Filters\PackageFilter;
use Modules\ApiV1\Http\Resources\PackageResource;

class PackageController
{
    /**
     * Display a listing of the resource.
     */
    /**
     * @unauthenticated
     */
    public function index(Request $request)
    {
        $filter = new PackageFilter;
        $queryItems = $filter->transform($request);
        // return $request->query('q');

        $packages = Package::with(['offer', 'category'])
            ->where($queryItems)
            ->whereAny([
                'title', 'destination',
            ], 'LIKE', '%'.$request->query('q').'%')
            ->paginate(9)
            ->appends($request->query());

        return PackageResource::collection($packages);
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
    /**
     * @unauthenticated
     */
    public function show(string $slug)
    {
        $package = Package::with('category', 'items', 'offer')
            ->where('slug', $slug)->firstOrFail();

        return response()->json([
            'package' => new PackageResource($package),
        ]);
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
