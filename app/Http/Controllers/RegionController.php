<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegionCollection;
use App\Http\Resources\RegionResource;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RegionController extends Controller
{

    public function index()
    {

        $user = auth()->guard('sanctum')->user();
        $regions = Region::where('user_id', $user->id)->get();
        return new RegionCollection($regions);
    }

    public function store(Request $request)
    {
        Region::validate($request);
        $region = Region::create([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'user_id' => auth()->guard('sanctum')->user()->id
        ]);

        return new RegionResource($region);
    }

    public function show($id)
    {
        $region = Region::find($id);
        if (!$region) {
            return response()->json([
                "message" => "Region not found"
            ], 404);
        }
        return new RegionResource($region);
    }

    public function update(Request $request, $id)
    {
        Region::validate($request);
        $region = Region::find($id);
        $region->update([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return new RegionResource($region);
    }

    public function destroy($id)
    {
        $region = Region::find($id);
        if (!$region) {
            return response()->json([
                "message" => "Region not found"
            ], 404);
        }
        $region->delete();
        return response()->json([
            "message" => "Region deleted"
        ]);

    }
}
