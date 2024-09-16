# Multi Tenant E-Library System

Instructions on settings up environment

> php artisan migrate --database="landlord" --path="database/migrations/landlord"

This command is used to migrate the tables that are required for landlord to function

> php artisan db:seed --database="landlord" --class="LandlordSeeder"

This command is used to seed the database for landlord for functional usage

Notice

This application uses pspdfkit-lib for pdf view.
due to the library large size dependencies were removed from public/assets which contained the pspdfkit-lib dependencies which you would have to install manually
