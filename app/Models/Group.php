<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Group extends Model
{
    use HasFactory;

    protected  $table = 'groups';

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function postBy()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
