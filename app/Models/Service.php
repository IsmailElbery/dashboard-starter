<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'photo',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Boot method to auto-set order
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (is_null($service->order)) {
                $service->order = (static::max('order') ?? 0) + 1;
            }
        });
    }

    /**
     * Scope to get only active services
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by order field
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Toggle active status
     */
    public function toggleStatus()
    {
        $this->is_active = !$this->is_active;
        $this->save();
        return $this;
    }
}
