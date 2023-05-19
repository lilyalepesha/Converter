<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 *
 */
class UserService extends BaseService
{
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        parent::__construct($userRepository);
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $role
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function filterByRole(int $role, int $perPage = 10): LengthAwarePaginator
    {
        return $this->userRepository->filterByRole($role, $perPage);
    }


}
