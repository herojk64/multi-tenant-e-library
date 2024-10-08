<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enum\ServicesStatusType;
use App\Enum\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'type'=>UserType::class
        ];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function abilities()
    {
        return $this->hasMany(Abilities::class);
    }

    public function tenants(){
        return $this->hasMany(Tenant::class,'user_id');
    }

    public function services()
    {
        return $this->hasMany(UserServices::class,'user_id');
    }

    public function getStatusAttribute(): bool
    {
        return $this->services()->where('status', ServicesStatusType::ACTIVE)->exists();
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class,'user_id');
    }

    public function searchLogs()
    {
        return $this->hasMany(SearchLog::class);
    }

    public function viewedBooks()
    {
        return $this->belongsToMany(Books::class, 'book_user_views')
            ->withTimestamps()
            ->withPivot('viewed_at');
    }



}
