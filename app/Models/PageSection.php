<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_type',
        'content',
        'order',
    ];

    protected $casts = [
        'content' => 'array',
    ];

    /**
     * The page that owns the section.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
