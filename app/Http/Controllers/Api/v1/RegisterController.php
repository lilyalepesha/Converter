<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\RegisterRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class RegisterController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="Register",
     *      tags={"Register"},
     *      summary="Регистрация",
     *      description="Возвращает информацию о пользователе",
     *      @OA\Parameter(
     *          name="name",
     *          description="User name",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *          @OA\Parameter(
     *          name="email",
     *          description="User email",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="email"
     *          )
     *      ),
     *          @OA\Parameter(
     *          name="password",
     *          description="User password",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *          @OA\Parameter(
     *          name="password_confirmation",
     *          description="Confirm password",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Вы успешно зарегистрированы",
     *           @OA\JsonContent(type="object",
     *           @OA\Property(property="status", type="boolean", example=true),
     *           @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/UserResource")),
     *           @OA\Property(property="token", type="string", example="6|PO3taClVXlakr3gHqBCzVe5cFLKCr4tG6ZcI1REU"),
     *          ),
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     * )
     */

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userService->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'status' => true,
            'data' => new UserResource($user),
            'token' => $token,
        ], 201);
    }
}
