<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class predict extends Model
{
    use HasFactory;

    protected $fillable = [
        'predict',
        'temp',
        'humidity',
        'rain',
        'sector_id'
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
    public function validate(Request $request)
    {
        return $request->validate([
            'predict' => 'required',
            'temp' => 'required',
            'humidity' => 'required',
            'rain' => 'required',
            'sector_id' => 'required|exists:sectors,id',
        ]);
    }



}
