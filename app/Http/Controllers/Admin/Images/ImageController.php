<?php

namespace App\Http\Controllers\Admin\Images;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

/**
 *
 */
class ImageController extends Controller
{

    protected UserService $userService;
    protected ImageService $imageService;

    /**
     * @param UserService $userService
     * @param ImageService $imageService
     */
    public function __construct(UserService $userService, ImageService $imageService)
    {
        $this->userService = $userService;
        $this->imageService = $imageService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {

        $users = $this->userService
            ->getModelWithCountRelationPaginate('images', ['id', 'name', 'email'],
                ['user_id', 'path', 'width', 'height', 'original_width', 'original_height', 'type'], 500);

        return view('admin.images.index', compact('users'));
    }
}
