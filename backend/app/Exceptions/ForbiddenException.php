<?php

namespace App\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    public function render()
    {
        return response()->json([
            'success' => false,
            'message' => 'Forbidden',
            'errors' => ['You do not have permission to access this resource.'],
        ], 403);
    }
}
