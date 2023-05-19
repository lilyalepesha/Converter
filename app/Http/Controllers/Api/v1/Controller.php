<?php

namespace App\Http\Controllers\Api\v1;

/**
 *
 * @OA\Server(url=L5_SWAGGER_CONST_HOST)
 * @OA\Info(title="UploadFile API", version="1")
 * @OA\PathItem(path="/"),
 *
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   in="header",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat="string",
 * )
 *
 */
class Controller extends \App\Http\Controllers\Controller
{

}
