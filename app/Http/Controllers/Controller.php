<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="TrashBusters API", version="0.1")
 */
class Controller extends BaseController
{
    /**
     * @OA\OpenApi(
     *      @OA\Info(
     *          version="1.0",
     *          title="API Dokumentáció",
     *          description="API",
     *      )
     * )
     */
    use AuthorizesRequests, ValidatesRequests;
}
