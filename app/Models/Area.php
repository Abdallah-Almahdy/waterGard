<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function sectors()
    {
        return $this->hasMany(Sector::class, 'area_id', 'id');
    }

    public static function validate(Request $request){
        return $request->validate([
            'name' => 'required',

        ]);
    }


}
