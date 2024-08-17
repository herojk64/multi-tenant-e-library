<?php

namespace App\Models;

use App\Enum\ServicesType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandlordServices extends Model
{
    use HasFactory;
    protected $table= 'services';
    protected $fillable = ['title','description','type','duration','amount','discount'];
    protected $casts =[
        'type' => ServicesType::class
    ];
}
