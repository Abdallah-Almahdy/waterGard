<?php

namespace App\Http\Controllers;

use App\Http\Resources\AreaCollection;
use App\Http\Resources\AreaResource;
use App\Models\Area;
use App\Models\Region;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function __construct(Request $request)
    {
       $this->middleware('auth.check');
    }


    public function index($id)
    {
        $areas = Area::where('region_id', $id)->get();
        return new AreaCollection($areas);
    }

    public function store(Request $request)
    {

        $area = Area::validate($request);
        $area = Area::create([
            'name' => $request['name'],
            'region_id' => $request['id']
        ]);
        return new AreaResource($area);
    }

    public function show($id)
    {

        $area = Area::find($id);
        if (!$area) {
            return response()->json(['message' => 'Area not found'], 404);
        }
        return new AreaResource($area);
    }

    public function update(Request $request, $id)
    {

        $area = Area::find($id);
        if (!$area) {
            return response()->json(['message' => 'Area not found'], 404);
        }
        $area->update($request->all());
        return new AreaResource($area);
    }

    public function destroy($id)
    {

        $area = Area::find($id);
        if (!$area) {
            return response()->json(['message' => 'Area not found'], 404);
        }
        $area->delete();
        return response()->json(['message' => 'Area deleted successfully'], 200);
    }
}
