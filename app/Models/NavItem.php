<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class NavItem extends Model
{
    use HasTranslations;

    public array $translatable = ['title'];

    protected $fillable = [
        'parent_id',
        'title',
        'url',
        'type',
        'target',
        'icon',
        'css_class',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Parent item (for dropdown children)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavItem::class, 'parent_id');
    }

    // Children items (dropdown items)
    public function children(): HasMany
    {
        return $this->hasMany(NavItem::class, 'parent_id')->where('is_active', true)->orderBy('order');
    }

    // Get only parent items (no parent_id)
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Get the URL (handle route names vs external URLs)
    public function getLink(): string
    {
        if (empty($this->url)) {
            return '#';
        }

        // Check if it's a route name
        if (\Illuminate\Support\Facades\Route::has($this->url)) {
            return route($this->url);
        }

        // Return as-is (external URL or anchor)
        return $this->url;
    }
}
