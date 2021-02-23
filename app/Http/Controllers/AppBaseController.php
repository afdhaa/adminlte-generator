<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 400)
    {
        // return Response::json(ResponseUtil::makeError($error), $code);
        return Response::json([
            'success' => false,
            'data' => [],
            'message' => $error
        ], 400);
    }

    public function sendSuccess($data, $message)
    {
        return Response::json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], 200);
    }
}
