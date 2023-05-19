<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Services\Registration\AvatarService;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use function redirect;
use function view;

/**
 *
 */
class RegisterController extends Controller
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
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        return view('pages.register');
    }


    /**
     * @param RegisterRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(RegisterRequest $request): Application|RedirectResponse|Redirector
    {

        $user = $this->userService->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$user) {
            return redirect()->route('register.index')->with('status', 'Ошибка регистрации');
        }

        Auth::login($user);

        $this->userService->update($user->id, [
            'avatar' => $this->avatarService->store($request->avatar),
        ]);
        //Mail::to($request->user())->send(new MailNotify($mailData));

        Event::dispatch(new UserCreatedEvent($user));

        /*  $user->notify(new DownloadFileNotification($user, '1083884193'));*/

        return redirect(RouteServiceProvider::HOME)->with('status', 'Вы успешно зарегистрированы');
    }
}




