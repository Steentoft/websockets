<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable = [
        "user_id",
        "contact_id",
        "created_at",
        "updated_at",
        ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'contact_id');
    }
}
