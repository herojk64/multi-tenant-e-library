<?php

namespace App\Tasks;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Exceptions\InvalidConfiguration;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\Tasks\SwitchTenantDatabaseTask;

class SwitchTenantDatabaseCustomTask extends SwitchTenantDatabaseTask
{
    public function makeCurrent(Tenant $tenant):void
    {
        $this->setTenantConnectionDatabase($tenant);
    }

    /**
     * @throws InvalidConfiguration
     */
    protected function setTenantConnectionDatabase(Tenant|null $tenant)
    {
        $database_name = $database_password = $database_username = null;
        if($tenant){
            $database_name = $tenant->database;
            $database_username = $tenant->database_username;
            $database_password = $tenant->display_database_password;
        }

        $config_tenant_database_name = $this->tenantDatabaseConnectionName();
        $config_landlord_database_name = $this->landlordDatabaseConnectionName();

        if($config_tenant_database_name === $config_landlord_database_name){
            throw InvalidConfiguration::tenantConnectionIsEmptyOrEqualsToLandlordConnection();
        }

        if(is_null(config("database.connections.{$config_tenant_database_name}"))){
            throw InvalidConfiguration::tenantConnectionDoesNotExist($config_tenant_database_name);
        }

        config([
            "database.connections.{$config_tenant_database_name}.database"=>$database_name,
           "database.connections.{$config_tenant_database_name}.username"=>$database_username,
            "database.connections.{$config_tenant_database_name}.password"=>$database_password,
        ]);
    }

    public function forgetCurrent(): void
    {
        $this->setTenantConnectionDatabase(null);
    }
}
