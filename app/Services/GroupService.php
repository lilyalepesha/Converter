<?php

namespace App\Services;

use App\Contracts\GroupRepositoryInterface;

/**
 *
 */
class GroupService extends BaseService
{
    /**
     * @var
     */
    protected $groupRepository;

    /**
     * @param GroupRepositoryInterface $groupRepository
     */
    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        parent::__construct($groupRepository);
    }


}
