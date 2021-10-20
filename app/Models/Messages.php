<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $fillable = [
        "sender",
        "receiver",
        "message",
        "media_link",
        "created_at",
        "updated_at",
    ];
}
