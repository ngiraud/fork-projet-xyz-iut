<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Code extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'host_id',
        'code',
        'consumed_at',
    ];

    protected $casts = [
        'consumed_at' => 'timestamp',
    ];

    public function host(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guest_id');
    }

    public function markAsUsed(User $guest): Code
    {
        $this->update([
            'consumed_at' => now(),
            'guest_id' => $guest->id,
        ]);

        return $this;
    }

    public function isNotUsed(): bool
    {
        return !$this->isUsed();
    }

    public function isUsed(): bool
    {
        return !empty($this->consumed_at) && !empty($this->guest_id);
    }
}
