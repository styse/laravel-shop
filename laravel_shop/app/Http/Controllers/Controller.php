<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * @OA\Info(
 *      version="1.0.1",
 *      title="Laravel shop",
 *      description="API of a simple shop website."
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Local Machine"
 * )
 * 
 * 
 * @OA\Tag(
 *     name="Providers",
 *     description="v1"
 * )
 * 
 * @OA\Tag(
 *     name="Users",
 *     description="v1"
 * )
 * 
 * @OA\Tag(
 *     name="Products",
 *     description="v1"
 * )
 *
 * @OA\Tag(
 *     name="Categories",
 *     description="v1"
 * )
 * 
 * @OA\Tag(
 *     name="Brands",
 *     description="v1"
 * )
 * 
 * @OA\Tag(
 *     name="Comments",
 *     description="v1"
 * )
 * 
*/
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
