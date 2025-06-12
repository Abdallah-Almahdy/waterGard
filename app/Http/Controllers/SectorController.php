<?php

namespace App\Http\Controllers;

use App\Http\Resources\SectorCollection;
use App\Http\Resources\SectorResource;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth.check');
    }

    public function index($government_id, $area_id)
    {

        return new SectorCollection(Sector::where('area_id', $area_id)->get());
    }

    public function show($id)
    {
        $sector = Sector::find($id);
        if ($sector) {
            return new SectorResource($sector);
        }
        return response()->json('Sector not found', 404);
        }

    public function store(Request $request)
    {
        Sector::validate($request);
        $sector = Sector::create([
            'crop_name' => $request->crop_name,
            'soil_type' => $request->soil_type,
            'season' => 'clay',
            'area' => $request->area,
            'irrigation_type' => $request->irrigation_type,
            'area_id' => $request->area_id,
        ]);

        $predictModel = new PredictController();
        $prediction = $predictModel->predict($request, $sector->id);
        return response()->json([
            'prediction' => $prediction
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $sector = Sector::find($id);
        if ($sector) {
            Sector::validate($request);
            $sector->update($request->all());
            return response()->json($sector, 200);
        }
        return response()->json('Sector not found', 404);
    }

    public function destroy($id)
    {
        $sector = Sector::find($id);
        if ($sector)
         {
            $sector->delete();
            return response()->json('Sector deleted', 200);
        }
        return response()->json('Sector not found', 404);
    }

}
