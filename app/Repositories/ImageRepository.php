<?php

namespace App\Repositories;

use App\Contracts\ImageRepositoryInterface;
use App\Models\Image;

/**
 *
 */
class ImageRepository extends BaseRepository implements ImageRepositoryInterface
{
    /**
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        parent::__construct($image);
    }


}
