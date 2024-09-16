<?php

namespace App\Models;

use App\Enum\ServicesStatusType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserServices extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'status' => ServicesStatusType::class
    ];

    public function user()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function setServiceAttribute($value) {
        if ($value instanceof Collection) {
            $this->attributes['service'] = $value->toJson();
        } elseif (is_array($value)) {
            $this->attributes['service'] = json_encode($value);
        } else {
            throw new \InvalidArgumentException('The value must be an instance of Collection or an array.');
        }
    }
    public function getServiceAttribute($value) {
        return json_decode($value, true);
    }
}
