<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abilities extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','ability'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
