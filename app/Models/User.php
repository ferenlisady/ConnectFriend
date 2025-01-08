<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Friend;
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
    protected $table = "users";
    protected $guarded = [];

    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    public function avatars()
    {
        return $this->belongsToMany(Avatar::class, 'avatar_transactions');
    }

    public function avatarTransactions()
    {
        return $this->hasMany(AvatarTransaction::class, 'user_id');
    }

    public function sentAvatars()
    {
        return $this->belongsToMany(Avatar::class, 'user_avatar_shares', 'sender_id', 'avatar_id');
    }

    public function receivedAvatars()
    {
        return $this->belongsToMany(Avatar::class, 'user_avatar_shares', 'receiver_id', 'avatar_id');
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
            'password' => 'hashed',
        ];
    }
}
