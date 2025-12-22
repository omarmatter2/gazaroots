<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Author extends Model
{
    use HasTranslations;

    public array $translatable = ['name', 'bio'];

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'avatar',
        'bio',
        'location',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getArticlesCountAttribute(): int
    {
        return $this->articles()->count();
    }
}
