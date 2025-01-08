<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvatarTransaction extends Model
{
    protected $table = "avatar_transactions";

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }
}
