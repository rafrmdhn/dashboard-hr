<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function intern()
    {
        return $this->hasMany(Intern::class);
    }

    public function employee()
    {
        return $this->hasMany(Staff::class);
    }
}
