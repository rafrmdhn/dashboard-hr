<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Talent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function earning()
    {
        return $this->hasMany(Earning::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where(function($subquery) use ($search) {
                $subquery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('instagram', 'like', '%' . $search . '%')
                        ->orWhere('linkedin', 'like', '%' . $search . '%');
            });
        });
    }
}
