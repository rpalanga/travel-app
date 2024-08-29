<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = ['holiday_id', 'name', 'img', 'description', 'place', 'date'];

    public function holiday()
    {
        return $this->belongsTo(Holiday::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }


}
