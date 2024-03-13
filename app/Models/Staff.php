<?php

namespace App\Models;

use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            $query->where(function($subquery) use ($search) {
                $subquery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('instagram', 'like', '%' . $search . '%')
                        ->orWhere('linkedin', 'like', '%' . $search . '%');
            })
            ->orWhereHas('position', function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['position'] ?? false, function($query, $position) {
            return $query->whereHas('position', function($query) use ($position) {
                $query->where('name', $position);
            });
        });
    }
}
