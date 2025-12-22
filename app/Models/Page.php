<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory, HasTranslations;

    /**
     * The attributes that are translatable.
     */
    public array $translatable = ['title', 'meta_description'];

    protected $fillable = [
        'title',
        'slug',
        'status',
        'meta_description',
    ];

    /**
     * The sections that belong to the page.
     */
    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }

    /**
     * Generate slug from title if not provided.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $title = $page->getTranslation('title', 'fr') ?? $page->title;
                $page->slug = Str::slug($title);
            }
        });
    }

    /**
     * Scope a query to only include published pages.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
