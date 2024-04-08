<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function earnable()
    {
        return $this->morphTo();
    }

    public function sows()
    {
        return $this->belongsToMany(Sow::class, 'earning_sow')->withPivot(['talent_rate', 'note'])->withTimestamps();
    }

    public function talent()
    {
        return $this->belongsTo(Talent::class);
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
