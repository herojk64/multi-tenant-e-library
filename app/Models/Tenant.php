<?php

namespace App\Models;

use App\Jobs\MigrateTenantTables;
use Database\Seeders\TenantSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Multitenancy\Models\Tenant as SpatieTenantModel;
class Tenant extends SpatieTenantModel
{
    protected $fillable = [
        'user_id','name', 'email', 'domain', 'database', 'database_username', 'database_password','is_active'
    ];

    protected static function booted()
    {
        static::creating(fn(Tenant $model) => $model->createDatabase());
        static::created(static fn(Tenant $tenant) => MigrateTenantTables::dispatch($tenant));
    }

    public function createDatabase()
    {
        $password = Str::random();
        $username = $this->fetchUniqueUsername();
        $dbname = $this->fetchUniqueDBUsername();


        DB::connection()->statement("CREATE USER '$username'@'%' IDENTIFIED BY '$password'");

        DB::connection()->statement("CREATE DATABASE $dbname");

        $privileges = "CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES";

        DB::connection()->statement("GRANT $privileges on $dbname.* TO '$username'@'%'");

        $this->database = $dbname;
        $this->database_username = $username;
        $this->database_password = Crypt::encrypt($password);
        $this->user_id = auth()->user()->id;

    }

    public function runMigration()
    {
        Artisan::call('tenants:artisan',[
            '--tenant' => $this->id,
            'artisanCommand' => 'migrate:fresh --seed --database=tenant --force',
        ]);
    }

    public function fetchUniqueUsername():string
    {
        do{
            $random = Str::random(8);
            $usernameExists = DB::connection('landlord')->table('tenants')->where('database_username',$random)->exists();
        }while($usernameExists);
        return $random;
    }
    public function fetchUniqueDBUsername():string{
        do{
            $random         = 'lib_' . strtolower(Str::random(8));
            $usernameExists = DB::connection('landlord')->table('INFORMATION_SCHEMA.SCHEMATA')
                ->where('SCHEMA_NAME', $random)->exists();
        }while($usernameExists);
        return $random;
    }

    public function getDisplayDatabasePasswordAttribute()
    {
        return Crypt::decrypt($this->database_password);
    }

    public function services()
    {
        return $this->hasMany(TenantService::class,'tenant_id');
    }

    public function users(){
        return $this->hasOne(User::class);
    }
}
