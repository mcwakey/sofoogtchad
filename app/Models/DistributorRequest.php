<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistributorRequest extends Model
{
    protected $fillable = [
        'company_name',
        'contact_name',
        'email',
        'phone',
        'city',
        'country',
        'message',
        'status',
        'admin_notes',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_REVIEWED = 'reviewed';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function markAsReviewed(): void
    {
        $this->update([
            'status' => self::STATUS_REVIEWED,
            'reviewed_at' => now(),
        ]);
    }

    public function approve(): void
    {
        $this->update([
            'status' => self::STATUS_APPROVED,
            'reviewed_at' => now(),
        ]);
    }

    public function reject(): void
    {
        $this->update([
            'status' => self::STATUS_REJECTED,
            'reviewed_at' => now(),
        ]);
    }
}
