<?php

namespace App\Constants;

class Roles
{
    const BARBER = 'barber';
    const ADMIN = 'admin';
    const CUSTOMER = 'customer';
    const SUPER_ADMIN = 'super_admin';
    const ALLOWED_ROLES = [
        self::ADMIN,
        self::BARBER,
        ];
}
