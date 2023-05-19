<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Api\v1\ImageResource;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class ImageController extends Controller
{
    /**
     * @var ImageService
     */
    protected $service;

    /**
     * @param ImageService $service
     */
    public function __construct(ImageService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      path="/images",
     *      operationId="ImagesList",
     *      tags={"Images"},
     *      security={ {"bearerAuth": {} }},
     *      summary="Получение списка изобраний пользователя",
     *      description="Возвращает список изображений",
     *      @OA\Response(
     *          response=200,
     *          description="Список изображений",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="status", type="boolean", example="true"),
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ImageResource")),
     *          ),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      )
     *     )
     */

    public function index(): JsonResponse
    {
        /*        $response = Image::query()->where('user_id', '=',  \auth()->id())
                    ->paginate(10);*/
        $response = $this->service->findByParamPaginate('user_id', '=', auth()->id());
        return response()->json([
            'status' => true,
            'data' => ImageResource::collection($response),
        ]);
    }
}
