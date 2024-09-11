<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Practice App API Documentation"
 * )
 */

class Controller extends BaseController
{
    /**
     * @OA\PathItem(path="/api")
     */
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;
}
