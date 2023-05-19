<?php

namespace App\Jobs\Images;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Imagick;
use ImagickException;
use InvalidArgumentException;
use ZipArchive;
use function storage_path;

/**
 *
 */
class ImageOperationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public int $tries = 3;
    /**
     * @var int
     */
    public int $timeout = 1200;

    /**
     * @var string
     */
    protected string $zipName;
    /**
     * @var string
     */
    protected string $path;
    /**
     * @var string|null
     */
    protected string|null $extension;
    /**
     * @var int|null
     */
    protected int|null $width;
    /**
     * @var int|null
     */
    protected int|null $height;

    /**
     * @var object
     */
    protected object $image;

    /**
     * @param string $zip_name
     * @param string $path
     * @param string|null $extension
     * @param int|null $width
     * @param int|null $height
     * @param object $image
     */
    public function __construct(string $zip_name, string $path, string|null $extension,
                                int|null   $width, int|null $height, object $image,

    )
    {
        $this->zipName = $zip_name;
        $this->path = $path;
        $this->extension = $extension;
        $this->width = $width;
        $this->height = $height;
        $this->image = $image;
    }


    /**
     * @return void
     */
    public function handle()
    {
        $zip = new ZipArchive();
        if (!$zip->open(storage_path('app/public/zipArchives/' . $this->zipName), ZipArchive::CREATE)) {
            throw new InvalidArgumentException('Не удалось открыть архив');
        }
        $this->processImage($zip);
    }

    /**
     * @param ZipArchive $zip
     * @return void
     */
    private function processImage(ZipArchive $zip)
    {
        foreach (File::files(storage_path('app/public/' . $this->path)) as $file) {
            $baseName = basename($file);
            try {
                $imagick = new Imagick(storage_path('app/public/' . $this->path . '/'
                    . $baseName));
                $this->resizeImages($imagick);
                $this->compressImages($imagick);
                $this->storeImages($imagick, $file, $baseName, $zip);
            } catch (ImagickException $e) {
                Log::channel('jobs')->error($e->getMessage());
            }
        }
        $zip->close();
    }

    /**
     * @param object $imagick
     * @return void
     */
    private function compressImages(object $imagick)
    {
        $imagick->setCompression(Imagick::COMPRESSION_JPEG);
        $imagick->setImageCompressionQuality(30);
    }

    /**
     * @param object $imagick
     * @return void
     */
    private function resizeImages(object $imagick)
    {
        if (isset($this->width) || isset($this->height)) {
            $imagick->thumbnailImage($this->width, $this->height);
        }
    }

    /**
     * @param object $imagick
     * @param string $file
     * @param string $baseName
     * @param ZipArchive $zip
     * @return void
     */
    private function storeImages(object $imagick, string $file, string $baseName, ZipArchive $zip)
    {
        $imagick->writeImage(storage_path('app/public/' . $this->path . '/' . $baseName));
        $zip->addFile($file, $baseName);
    }
}
