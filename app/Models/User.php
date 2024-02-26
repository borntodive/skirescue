<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Auth\User as Authenticatable;
use MongoDB\Laravel\Eloquent\Builder;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\RoleEnum;
use App\Enums\TypeEnum;
use Mockery\Matcher\Type;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'type' => TypeEnum::class,
        'role' => RoleEnum::class,
    ];

    public function opscentral()
    {
        return $this->belongsTo(Opscentral::class);
    }
    public function skiarea()
    {
        return $this->belongsTo(Skiarea::class);
    }

    public function scopeRescuer(Builder $query): void
    {
        $query->where('type', '=', TypeEnum::RESCUER->value);
    }
}
