<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TenantService extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_id','service'];

    public function tenants()
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
