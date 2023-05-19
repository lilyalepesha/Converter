<?php

namespace App\RevaltoModelFilter\src\Interfaces;
use Illuminate\Database\Eloquent\Builder;

interface ModelFilterInterface
{
    /**
     * @return Builder
     */
    public function filter(): Builder;

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed|null
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool;
}
