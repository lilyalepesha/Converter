<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use function auth;

/**
 *
 */
class LogoutController extends Controller
{
    /**
     * @OA\Post(
     *      path="/logout",
     *      operationId="Logout",
     *      tags={"Logout"},
     *      security={ {"bearerAuth": {} }},
     *      summary="Выход из аккаунта",
     *      description="Выход из аккаунта",
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message", type="string", example="Unauthorized"),
     *          ),
     *      ),
     *   ),
     *
     */

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }
}
