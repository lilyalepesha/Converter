<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected UserService $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $users = User::query()
            ->filter(['filter_by_role' => $request->filter, 'search_users_by_params' => $request->search])
            ->paginate(300)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('admin.users.create');
    }

    /**
     * @param UserCreateRequest $request
     * @return RedirectResponse
     */
    public function store(UserCreateRequest $request): RedirectResponse
    {
        $this->service->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('users.user.index')->with('status', 'Пользователь успешно добавлен');
    }

    public function show(User $user): Factory|View|Application
    {
        $relations = $this->service->getRepository()
            ->withRelationsCountById(['images', 'zips'], $user->id);
        return view('admin.users.show', compact('user', 'relations'));
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user): Application|Factory|View
    {
        return view('admin.users.edit', compact('user'));
    }


    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->service->update($user->id, [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('users.user.index')->with('status', 'Пользователь обновлён');
    }


    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->service->delete($user->id);
        return redirect()->route('users.user.index')->with('status', 'Пользователь удалён');
    }
}
