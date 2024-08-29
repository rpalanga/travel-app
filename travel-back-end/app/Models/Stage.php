<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = ['day_id', 'name', 'img', 'description', 'latitude', 'longitude'];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
