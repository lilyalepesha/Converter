<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Api\v1\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class LoginController extends Controller
{
    /**
     * @var UserService
     */
    protected $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="Login",
     *      tags={"Login"},
     *      summary="Вход в аккаунт",
     *      description="Возвращает информацию о пользователе",
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
     *      @OA\Response(
     *          response=200,
     *          description="Вы вошли в аккаунт",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/UserResource")),
     *              @OA\Property(property="token", type="string", example="8|PO3taClVXlakr3gHqBCzVe5cFLKCr4tG6ZcI1REU"),
     *          ),
     *       ),
     *
     *      @OA\Response(
     *          response=404,
     *          description="Такого пользователя не существует",
     *          @OA\JsonContent(type="object",
     *               @OA\Property(property="status", type="boolean", example=false),
     *               @OA\Property(property="message", type="string", example="Такого пользователя не существует"),
     *          ),
     *      ),
     * )
     */

    public function login(LoginRequest $request): JsonResponse
    {

        /*        $user = User::query()->where('email', '=', $request->email)->first();*/
        $user = $this->service->findByParamFirst('email', '=', $request->email);
        if (!$user || !Hash::check($request->password, $user['password'])) {
            return response()->json([
                'status' => false,
                'message' => 'Такого пользователя не существует',
            ], 404);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'status' => true,
            'data' => new UserResource($user),
            'token' => $token,
        ], 200);
    }

}
