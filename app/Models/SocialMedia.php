<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media';

    protected $fillable = [
        'platform',
        'image',
        'hover_image',
        'url',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return Storage::url($this->image);
        }
        return asset('website/assets/img/social/default.svg');
    }

    /**
     * Get the hover image URL
     */
    public function getHoverImageUrlAttribute(): string
    {
        if ($this->hover_image) {
            return Storage::url($this->hover_image);
        }
        return $this->image_url;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
