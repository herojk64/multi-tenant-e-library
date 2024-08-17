<?php

namespace App\Enum;

enum UserType:string
{
    CASE LANDLORD = 'landlord';
    CASE ADMIN = 'admin';
    CASE TENANT = 'tenant';
    CASE USER = 'user';
}
