<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Talent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categories()
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
        $query->when($filters['search'] ?? null, function($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? null, function($query, $categories) {
            $query->whereHas('categories', function($query) use ($categories) {
                $query->whereIn('name', (array) $categories);
            });
        });
    }
}
