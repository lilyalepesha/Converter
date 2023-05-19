<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileRequest;
use App\Services\Registration\AvatarService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 *
 */
class UserProfileController extends Controller
{
    /**
     * @var AvatarService
     */
    protected AvatarService $avatarService;
    /**
     * @var UserService
     */
    protected UserService $userService;

    /**
     * @param AvatarService $avatarService
     * @param UserService $userService
     */
    public function __construct(AvatarService $avatarService, UserService $userService)
    {
        $this->avatarService = $avatarService;
        $this->userService = $userService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.userProfile');
    }

    /**
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileRequest $request): RedirectResponse
    {
        $this->userService->update(Auth::id(), [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->userService->update(Auth::id(), [
            'avatar' => $this->avatarService->store($request->avatar),
        ]);

        return redirect()->back()->with('status', 'Профиль успешно обновлён');
    }
}
