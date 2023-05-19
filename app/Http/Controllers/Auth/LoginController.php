<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use function redirect;
use function view;

/**
 *
 */
class LoginController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('pages.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->only("email", 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('service.index')->with('status', 'Вход в аккаунт выполнен успешно');
        }
        return redirect()->back()->with('status', 'Ошибка авторизации');
    }
}
