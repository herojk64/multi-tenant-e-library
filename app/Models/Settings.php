<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = ['key','value','type'];
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $value;
        $this->attributes['type'] = $this->getTypeOf($value);
    }

    /**
     * Determine the type of a value.
     *
     * @param mixed $value
     * @return string
     */
    protected function getTypeOf($value)
    {
        return match (true) {
            is_numeric($value) => is_int($value) ? 'integer' : 'float',
            is_bool($value) => 'boolean',
            is_string($value) => 'string',
            is_array($value) => 'array',
            is_null($value) => 'null',
            default => 'unknown',
        };
    }

    public function getValueAttribute()
    {
        return match ($this->attributes['type']) {
            'integer' => (int) $this->attributes['value'],
            'float' => (float) $this->attributes['value'],
            'boolean' => filter_var($this->attributes['value'], FILTER_VALIDATE_BOOLEAN),
            'array' => json_decode($this->attributes['value'], true),
            'null' => null,
            'string'=>$this->attributes['value'],
            default => (string) $this->attributes['value'],
        };
    }

    protected static function booted()
    {
        static::saved(function ($settings) {
            // Clear the cache when a setting is created or updated
            Cache::forget('tenant.settings');
        });

        static::deleted(function ($settings) {
            // Clear the cache when a setting is deleted
            Cache::forget('tenant.settings');
        });
    }
}
