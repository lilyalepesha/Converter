<?php

namespace App\Jobs\Images;

use App\Models\Image;
use App\Models\ImageToZip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 *
 */
class StoreImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $tries = 3;

    private $images;
    protected $width;
    protected $height;
    protected $group;
    protected $path;
    protected $zipArchive;

    public function __construct($images, $width, $height, $group, $path, $zipArchive)
    {
        $this->images = $images;
        $this->width = $width;
        $this->height = $height;
        $this->group = $group;
        $this->path = $path;
        $this->zipArchive = $zipArchive;
    }

    /**
     * @return void
     */
    public function handle()
    {
        foreach ($this->images as $key => $item) {
            $name = rand(0, 1000) . Str::random(10) . '.' . $item->extension();
            Storage::putFileAs($this->path, $item, $name);
            $size = getimagesize($item);
            $image = $this->imageService->create([
                'name' => pathinfo($name, PATHINFO_FILENAME),
                'width' => $this->width,
                'height' => $this->height,
                'type' => $item->extension(),
                'file' => pathinfo($item->getClientOriginalName(), PATHINFO_FILENAME),
                'user_id' => Auth::id(),
                'group_id' => $this->group['id'],
                'original_width' => $size[0],
                'original_height' => $size[1],
            ]);
        }
        $imageToZip = ImageToZip::query()->create([
            'image_id' => $image->id,
            'zip_id' => $this->zipArchive->id,
        ]);
    }

}
