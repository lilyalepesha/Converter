<?php

namespace App\Services;

use App\Contracts\ZipArchiveRepositoryInterface;

/**
 *
 */
class ZipArchiveService extends BaseService
{
    /**
     * @var
     */
    protected $zipArchiveRepository;

    /**
     * @param ZipArchiveRepositoryInterface $zipArchiveRepository
     */
    public function __construct(ZipArchiveRepositoryInterface $zipArchiveRepository)
    {
        parent::__construct($zipArchiveRepository);
    }
}
