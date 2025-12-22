<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasMedia
{
    public function media(): MorphToMany
    {
        return $this->morphToMany(Media::class, 'mediable')
            ->withPivot(['collection', 'sort_order'])
            ->orderBy('sort_order');
    }

    public function getMedia(string $collection = 'default'): \Illuminate\Database\Eloquent\Collection
    {
        return $this->media()->wherePivot('collection', $collection)->get();
    }

    public function getFirstMedia(string $collection = 'default'): ?Media
    {
        return $this->media()->wherePivot('collection', $collection)->first();
    }

    public function getFirstMediaUrl(string $collection = 'default'): ?string
    {
        $media = $this->getFirstMedia($collection);
        return $media?->url;
    }

    public function attachMedia(int|array $mediaIds, string $collection = 'default'): void
    {
        $mediaIds = is_array($mediaIds) ? $mediaIds : [$mediaIds];
        $maxOrder = $this->media()->wherePivot('collection', $collection)->max('sort_order') ?? 0;

        foreach ($mediaIds as $index => $mediaId) {
            $this->media()->syncWithoutDetaching([
                $mediaId => [
                    'collection' => $collection,
                    'sort_order' => $maxOrder + $index + 1,
                ],
            ]);
        }
    }

    public function syncMedia(array $mediaIds, string $collection = 'default'): void
    {
        $this->media()->wherePivot('collection', $collection)->detach();

        foreach ($mediaIds as $index => $mediaId) {
            $this->media()->attach($mediaId, [
                'collection' => $collection,
                'sort_order' => $index,
            ]);
        }
    }

    public function detachMedia(int|array $mediaIds, string $collection = 'default'): void
    {
        $mediaIds = is_array($mediaIds) ? $mediaIds : [$mediaIds];
        $this->media()->wherePivot('collection', $collection)->detach($mediaIds);
    }

    public function clearMediaCollection(string $collection = 'default'): void
    {
        $this->media()->wherePivot('collection', $collection)->detach();
    }

    public function hasMedia(string $collection = 'default'): bool
    {
        return $this->media()->wherePivot('collection', $collection)->exists();
    }
}
