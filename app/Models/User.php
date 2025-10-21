<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

      // If you want constants to avoid magic strings
    public const ROLE_USER  = 'user';
    public const ROLE_ADMIN = 'admin';

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

        protected static function booted()
    {
        static::created(function ($user) {
            // Create a wallet automatically
            \App\Models\Wallet::create([
                'user_id' => $user->id,
                'account_number' => self::generateAccountNumber(),
                'balance' => 0,
            ]);
        });
    }

    public static function generateAccountNumber()
    {
        do {
            $account = '66' . mt_rand(10000000, 99999999); // e.g. 6612345678
        } while (self::where('virtual_account', $account)->exists());

        return $account;
    }



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
            'date_joined' => 'datetime', // Assuming you have a custom 'date_joined' column
            'password' => 'hashed',
        ];
    }



}
