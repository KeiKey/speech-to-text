<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\RestTrait;

/**
 * @OA\Info(title="API V1", version="0.1")
 */
class BaseController extends Controller
{
    use RestTrait;
}
