<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function brand()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function talent()
    {
        return $this->belongsToMany(Talent::class);
    }
}
