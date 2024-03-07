<?php

namespace App\Models;

use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intern extends Model
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
                        ->orWhere('linkedin', 'like', '%' . $search . '%')
                        ->orWhere('university', 'like', '%' . $search . '%');
            })
            ->orWhereHas('position', function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
    }
}
