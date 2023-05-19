<?php

namespace Tests;

use App\Models\Image;
use App\Models\User;
use App\Models\Zip;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 *
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    /**
     * @return mixed
     */
    public function createUser()
    {
        return User::factory()->userTesting()->create();
    }

    /**
     * @param string $mimeType
     * @param $width
     * @param $height
     * @param int $size
     * @return File
     */
    public function createImage(string $mimeType, $width, $height, int $size)
    {
        return UploadedFile::fake()
            ->image(rand(0, 1000) . Str::random(10) . '.' . $mimeType,
                $width, $height)
            ->size($size);
    }

    /**
     * @param int $count
     * @return Collection|HasFactory|Model|mixed
     */
    public function createZip(int $count)
    {
        return Zip::factory($count)->create();
    }

    /**
     * @return mixed
     */
    public function createFakeEmail()
    {
        return fake()->unique()->safeEmail();
    }

    /**
     * @return mixed
     */
    public function createAdmin()
    {
        return User::factory()->createAdmin()->create();
    }

}
