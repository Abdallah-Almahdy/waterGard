<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'crop_name',
        'soil_type',
        'season',
        'area',
        'irrigation_type',
        'area_id',
        'ph'];

    public function Area()
    {
        return $this->belongsTo(Area::class,'area_id','id');
    }

    public static function validate(Request $request)
    {
        return $request->validate([
            'crop_name' => 'required|string',
            'soil_type' => 'required|string',
            'season' => 'required|string',
            'area' => 'required|numeric',
            'irrigation_type' => 'required',
            'area_id' => 'required|exists:areas,id',

        ]);
    }


}
