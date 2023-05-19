<?php

namespace App\Providers;

use App\Contracts\Admin\BaseAdminRepositoryInterface;
use App\Contracts\Admin\UserAdminRepositoryInterface;
use App\Contracts\BaseRepositoryInterface;
use App\Contracts\GroupRepositoryInterface;
use App\Contracts\ImageRepositoryInterface;
use App\Contracts\ImageToZipRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\ZipArchiveRepositoryInterface;
use App\Repositories\Admin\BaseAdminRepository;
use App\Repositories\Admin\UserAdminRepository;
use App\Repositories\BaseRepository;
use App\Repositories\GroupRepository;
use App\Repositories\ImageRepository;
use App\Repositories\ImageToZipRepository;
use App\Repositories\UserRepository;
use App\Repositories\ZipArchiveRepository;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->bind(ZipArchiveRepositoryInterface::class, ZipArchiveRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(GroupRepositoryInterface::class, GroupRepository::class);
        $this->app->bind(ImageToZipRepositoryInterface::class, ImageToZipRepository::class);
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
