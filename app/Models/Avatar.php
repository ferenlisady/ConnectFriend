<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $table = 'avatars';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'avatar_transactions');
    }

    public function transactions()
    {
        return $this->hasMany(AvatarTransaction::class);
    }
}
