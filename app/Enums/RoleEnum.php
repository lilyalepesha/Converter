<?php

namespace App\Enums;


enum RoleEnum: int
{
    case USER = 1;
    case ADMIN = 2;

    /**
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Администратор',
            self::USER => 'Пользователь',
        };
    }
}
