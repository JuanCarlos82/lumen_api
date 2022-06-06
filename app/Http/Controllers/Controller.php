<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
     /**
     * @OA\Info( title="API DOC ", version="1.0",
     *   description="Apis para la administracion"
     * ),
     * @OA\SecurityScheme(
     *      securityScheme="token",
     *      type="apiKey",
     *      name="Authorization",
     *      in="header"
     *     ),
     */
}
