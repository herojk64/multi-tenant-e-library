# Multi Tenant E-Library System

Instructions on settings up environment

> php artisan migrate --database="landlord" --path="database/migrations/landlord"

This command is used to migrate the tables that are required for landlord to function

> php artisan db:seed --database="landlord" --class="LandlordSeeder"

This command is used to seed the database for landlord for functional usage
