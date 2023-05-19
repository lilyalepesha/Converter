<?php

namespace App\Repositories;

use App\Contracts\ImageToZipRepositoryInterface;
use App\Models\ImageToZip;

/**
 *
 */
class ImageToZipRepository extends BaseRepository implements ImageToZipRepositoryInterface
{
    /**
     * @param ImageToZip $imageToZip
     */
    public function __construct(ImageToZip $imageToZip)
    {
        parent::__construct($imageToZip);
    }

}
