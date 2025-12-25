<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    public function createdCustomers()
    {
        return $this->hasMany(Customer::class, 'created_by');
    }

    public function createdMitraImages()
    {
        return $this->hasMany(MitraImage::class, 'created_by');
    }

    public function mitra()
    {
        return $this->hasOne(Mitra::class, 'created_by', 'id');
    }

    public function subscription()
    {
        return $this->hasOne(UserSubscription::class);
    }

    public function isPro()
    {
        return $this->subscription?->isActive() ?? false;
    }

}
