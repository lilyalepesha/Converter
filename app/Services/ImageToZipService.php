<?php

namespace App\Services;


use App\Contracts\ImageToZipRepositoryInterface;

/**
 *
 */
class ImageToZipService extends BaseService
{
    /**
     * @var
     */
    protected $imageToZipRepository;

    /**
     * @param ImageToZipRepositoryInterface $imageToZipRepository
     */
    public function __construct(ImageToZipRepositoryInterface $imageToZipRepository)
    {
        parent::__construct($imageToZipRepository);
    }

}
