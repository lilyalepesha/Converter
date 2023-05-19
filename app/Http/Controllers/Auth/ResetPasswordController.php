<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Notifications\CustomResetPasswordNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use function event;
use function redirect;
use function view;

/**
 *
 */
class ResetPasswordController extends Controller
{
    /**
     * @param $token
     * @return Application|Factory|View
     */
    public function index($token): Application|Factory|View
    {
        return view('service.reset-password', compact('token'));
    }

    /**
     * @param ResetPasswordRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(ResetPasswordRequest $request): Application|RedirectResponse|Redirector
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();

                event(new CustomResetPasswordNotification($user->getRememberToken()));
                //Mail::to(Auth::user())->send(new ResetPasswordNotify($user->getRememberToken()));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login.index')->with('status', 'Пароль успешно сброшен')
            : redirect(RouteServiceProvider::HOME)->with('status', 'Не получилось сбросить пароль');
    }
}
