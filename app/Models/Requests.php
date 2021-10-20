<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = [
        "sender",
        "receiver",
        "created_at",
        "updated_at",
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'receiver');
    }
}
