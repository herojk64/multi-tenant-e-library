<?php

namespace App\Enum;

enum UserType:string
{
    CASE LANDLORD = 'landlord';
    CASE LANDLORD_EMPLOYEE = 'landlord_employee';
    CASE ADMIN = 'admin';
    CASE TENANT = 'tenant';
    CASE TENANT_EMPLOYEE = 'tenant_employee';
    CASE USER = 'user';
}
