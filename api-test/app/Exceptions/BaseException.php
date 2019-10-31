<?php

namespace App\Exceptions;

use Exception;

class BaseException extends Exception
{
    public function jsonErrorResponse($request, Exception $exception)
    {
        return response()->json([
            'status' => [
                'code'    => $exception->getCode(),
                'message' => $exception->getMessage()
            ]
        ], 404);
    }
}
