<?php

namespace App\Http\Controllers;

use App\Models\predict;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class PredictController extends Controller
{
    public function predict(Request $request,$sector_id)
    {

        // $response = Http::post('http://127.0.0.1:5000/predict', [
        //     'Crop' => 'Wheat',
        //     'Soil' => 'Clay',
        //     'Irrigation' => 'Drip',
        //     'Area' => 100.0,
        //     'Temp' => 26.0,
        //     'Humidity' => 60.0,
        //     'Rain' => 12.5,
        // ]);

        // $prediction = $response->json()['prediction'];
        $predict = predict::create([
            'predict' => 0.54,
            'temp' => $request->input('temp', 26.0), // default value if not provided
            'humidity' => 60.0,
            'rain' => 12.5,
            'sector_id' => $sector_id,
        ]);
        return $predict;
    }

    public function getPredictions(Request $request)
    {
        $regions = Region::where('user_id', auth()->id())
            ->with('areas.sectors.predicts') // eager load all nested relations
            ->get();

        $data = $regions->map(function ($region) {
            return [
                'region' => $region->name,
                'areas' => $region->areas->map(function ($area) {
                    return [
                        'area' => $area->name,
                        'sectors' => $area->sectors->map(function ($sector) {
                            return [
                                'sector' => $sector->name,
                                'predictions' => $sector->predicts->map(function ($predict) {
                                    return [
                                        'predict' => $predict->predict,
                                        'temp' => $predict->temp,
                                        'humidity' => $predict->humidity,
                                        'rain' => $predict->rain,
                                    ];
                                }),
                            ];
                        }),
                    ];
                }),
            ];
        });

        return response()->json($data);
    }

}
