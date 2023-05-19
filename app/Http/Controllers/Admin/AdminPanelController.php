<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use App\Services\UserService;
use App\Services\ZipArchiveService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

/**
 *
 */
class AdminPanelController extends Controller
{
    /**
     * @var ImageService
     */
    protected ImageService $imageService;
    /**
     * @var ZipArchiveService
     */
    protected ZipArchiveService $zipService;
    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * @param ImageService $imageService
     * @param ZipArchiveService $zipService
     * @param UserService $userService
     */
    public function __construct(ImageService      $imageService,
                                ZipArchiveService $zipService,
                                UserService       $userService)
    {
        $this->imageService = $imageService;
        $this->zipService = $zipService;
        $this->userService = $userService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $images = Cache::remember('imagesCount', Carbon::now()->addMinute(), function () {
            return $this->imageService->getCount();
        });

        $zipArchives = Cache::remember('zipsCount', Carbon::now()->addMinute(), function () {
            return $this->zipService->getCount();
        });

        $users = Cache::remember('usersCount', Carbon::now()->addMinute(), function () {
            return $this->userService->getCount();
        });

        return view('admin.index', compact('images', 'zipArchives', 'users'));
    }
}
