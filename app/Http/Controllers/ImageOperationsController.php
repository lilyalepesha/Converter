<?php

namespace App\Http\Controllers;

use App\Events\DownloadFileEvent;
use App\Http\Requests\ImgRequest;
use App\Jobs\Images\ImageOperationsJob;
use App\Models\ImageToZip;
use App\Services\GroupService;
use App\Services\ImageService;
use App\Services\ImageToZipService;
use App\Services\UserService;
use App\Services\ZipArchiveService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 *
 */
class ImageOperationsController extends Controller
{

    /**
     * @var ZipArchiveService
     */
    protected ZipArchiveService $zipArchiveService;
    /**
     * @var ImageService
     */
    protected ImageService $imageService;
    /**
     * @var GroupService
     */
    protected GroupService $groupService;
    /**
     * @var ImageToZipService
     */
    protected ImageToZipService $imageToZipService;

    /**
     * @var UserService $userService
     */
    protected UserService $userService;

    /**
     * @param ZipArchiveService $zipArchiveService
     * @param ImageService $imageService
     * @param GroupService $groupService
     * @param ImageToZipService $imageToZipService
     * @param UserService $userService
     */
    public function __construct(ZipArchiveService $zipArchiveService,
                                ImageService      $imageService,
                                GroupService      $groupService,
                                ImageToZipService $imageToZipService,
                                UserService       $userService,

    )
    {
        $this->zipArchiveService = $zipArchiveService;
        $this->imageService = $imageService;
        $this->groupService = $groupService;
        $this->imageToZipService = $imageToZipService;
        $this->userService = $userService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.index');
    }


    /**
     * @param ImgRequest $request
     * @return RedirectResponse
     */
    public function store(ImgRequest $request): RedirectResponse
    {
        $path = 'images/' . rand(0, 1000) . Str::random(10);
        $extension = $request->extension;
        $width = $request->width;
        $height = $request->height;
        $zipName = rand(0, 1000) . Str::random(10) . '.zip';

        $zipArchive = $this->zipArchiveService->create([
            'name' => pathinfo($zipName, PATHINFO_FILENAME),
            'user_id' => Auth::id(),
        ]);

        $group = $this->groupService->create([
            'group_name' => str_replace('images/', '', $path),
            'zip_id' => $zipArchive->id,
        ]);

        $image = $this->imageService->store($request->file('image', []),
            $path, $width, $height, $group, $extension);

        $imageToZip = ImageToZip::query()->create([
            'image_id' => $image->id,
            'zip_id' => $zipArchive->id,
        ]);

        ImageOperationsJob::dispatch($zipName, $path, $extension, $width, $height, $image);

        return redirect()->route('service.download');
    }

    /**
     * @return Application|Factory|View
     */
    public function downloadFiles(): Application|Factory|View
    {
        Event::dispatch(new DownloadFileEvent(Auth::user()));

        $zipNames = $this->userService->getRepository()
            ->loadRelationById(Auth::id(), 'zips', ['id'], ['name', 'user_id']);

        $lastArchive = $this->userService
            ->loadRelationByIdOrderByRelation(Auth::id(), 'zips', ['id'], ['created_at', 'user_id'],
                'name', 'desc');

        return view('pages.download', compact('zipNames', 'lastArchive'));
    }
}
