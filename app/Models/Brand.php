<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function finance()
    {
        return $this->hasMany(Earning::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where(function($subquery) use ($search) {
                $subquery->where('name', 'like', '%' . $search . '%');
            });
        });
    }
}
