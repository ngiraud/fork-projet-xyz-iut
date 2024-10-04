<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Services\CodeService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted(): void
    {
        static::created(function (User $user) {
            $user->generateCodes();
        });
    }

    public function generateCodes(): User
    {
        $codes = app(CodeService::class)->generate();

        $this->codes()->createMany(array_map(fn($code) => [
            'code' => $code,
        ], $codes));

        return $this;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected function username(): Attribute
    {
        return Attribute::make(
            get: fn() => 'user'.str_pad((string) $this->id, 4, "0", STR_PAD_LEFT),
        );
    }

    public function codes(): HasMany
    {
        return $this->hasMany(Code::class, 'host_id');
    }
}
