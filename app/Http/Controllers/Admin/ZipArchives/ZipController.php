<?php

namespace App\Http\Controllers\Admin\ZipArchives;

use App\Http\Controllers\Controller;
use App\Models\User;
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
class ZipController extends Controller
{
    protected UserService $userService;
    protected ZipArchiveService $zipArchiveService;

    public function __construct(UserService $userService, ZipArchiveService $zipArchiveService)
    {
        $this->userService = $userService;
        $this->zipArchiveService = $zipArchiveService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $users = $this->userService
            ->getModelWithCountRelationPaginate('zips', ['name', 'email', 'id'], ['name', 'user_id'], 500);

        return view('admin.zipArchives.index', compact('users'));
    }
}
