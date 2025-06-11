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



}
