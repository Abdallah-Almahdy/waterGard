<?php

namespace App\Http\Controllers;

use App\Models\predict;
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
            'temp' => 26.0,
            'humidity' => 60.0,
            'rain' => 12.5,
            'sector_id' => $sector_id,
        ]);
        return $predict;
    }

    public function getPredictions(Request $request) {



    }

}
