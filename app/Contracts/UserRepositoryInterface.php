<?php

namespace App\Contracts;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param int $role
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function filterByRole(int $role, int $perPage = 10):LengthAwarePaginator;
}
