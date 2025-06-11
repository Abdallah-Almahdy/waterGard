<?php

namespace App\Http\Controllers;

use App\Models\predict;
use Illuminate\Http\Request;

class PredictController extends Controller
{
    public function predict(Request $request)
    {
        predict::validate($request);
        
    }

    public function getPredictions(Request $request) {


    }

}
