<?php

namespace App\Repositories;

use App\Contracts\GroupRepositoryInterface;
use App\Models\GroupImage;

/**
 *
 */
class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{
    /**
     * @param GroupImage $groupImage
     */
    public function __construct(GroupImage $groupImage)
    {
        parent::__construct($groupImage);
    }


}
