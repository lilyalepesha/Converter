<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * @param int $role
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function filterByRole(int $role, int $perPage = 10): LengthAwarePaginator
    {
        return $this->findByParamPaginate('role', '=', $role, $perPage);
    }


}
