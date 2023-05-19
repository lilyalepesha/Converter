<?php

namespace App\Services;

use App\Contracts\ImageRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 *
 */
class ImageService extends BaseService
{
    /**
     * @var
     */
    protected $imageRepository;

    /**
     * @param ImageRepositoryInterface $imageRepository
     */
    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        parent::__construct($imageRepository);
    }


    /**
     * @param array $images
     * @param string $path
     * @param int|null $width
     * @param int|null $height
     * @param object $group
     * @param string|null $extension
     * @return object
     */
    public function store(array    $images, string $path, int|null $width,
                          int|null $height, object $group, string|null $extension):object
    {

        foreach ($images as $key => $item) {
            $size = getimagesize($item);
            $imageType = is_null($extension) ? $item->extension() : $extension;
            $name = rand(0, 1000) . Str::random(10) . '.' . $imageType;
            Storage::putFileAs('public/' . $path, $item, $name);
            $image = $this->create([
                'name' => pathinfo($name, PATHINFO_FILENAME),
                'width' => $width,
                'height' => $height,
                'type' => $imageType,
                'path' => $group->group_name . '/' .  $name,
                'file' => pathinfo($item->getClientOriginalName(), PATHINFO_FILENAME),
                'user_id' => Auth::id(),
                'group_id' => $group->id,
                'original_width' => $size[0],
                'original_height' => $size[1],
            ]);
        }
        return $image;
    }

}
