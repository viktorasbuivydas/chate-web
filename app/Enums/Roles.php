<?php

namespace App\Enums;

enum Roles: string
{
    case Admin = 'admin';
    case Moderator = 'moderator';
    case User = 'user';

    public static function getRoles(): array
    {
        return [
            self::Admin,
            self::Moderator,
            self::User,
        ];
    }
}
