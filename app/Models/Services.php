<?php

namespace App\Models;

use App\Enum\ServicesType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $table= 'services';
    protected $guarded = [];

    protected $casts =[
        'type' => ServicesType::class
    ];



}
