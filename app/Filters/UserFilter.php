<?php

namespace App\Filters;

use App\RevaltoModelFilter\src\ModelFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 *
 */
class UserFilter extends ModelFilter
{
    /**
     * @var array
     */
    protected array $defaults = [
        'role' => self::COMPOSITION_EQUAL,
        'name' => self::COMPOSITION_LIKE,
        'email' => self::COMPOSITION_LIKE,
    ];


    public function filterByRole(int $value)
    {
        $this->query->where('role', '=', $value);
    }

    public function searchUsersByParams(string $search)
    {
        $this->query->where('name', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%");
    }
}
