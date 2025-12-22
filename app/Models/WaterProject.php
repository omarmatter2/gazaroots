<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class WaterProject extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'description'];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'location',
        'wells_built',
        'beneficiaries',
        'families_served',
        'neighborhoods',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'wells_built' => 'integer',
        'beneficiaries' => 'integer',
        'families_served' => 'integer',
        'neighborhoods' => 'integer',
    ];

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getTotalDonationsAttribute(): float
    {
        return $this->donations()->where('status', 'completed')->sum('amount');
    }
}
