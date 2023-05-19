<?php

namespace App\Repositories;

use App\Contracts\ZipArchiveRepositoryInterface;
use App\Models\Zip;

/**
 *
 */
class ZipArchiveRepository extends BaseRepository implements ZipArchiveRepositoryInterface
{
    /**
     * @param Zip $zip
     */
    public function __construct(Zip $zip)
    {
        parent::__construct($zip);
    }

}
