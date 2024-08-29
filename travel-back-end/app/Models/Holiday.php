<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'img', 'description'];

    public function days()
    {
        return $this->hasMany(Day::class);
    }
}
