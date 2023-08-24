<?php

namespace App\Classes;

use App\Classes\Response as BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse extends BaseResponse
{
    public function __construct(
        public readonly mixed $data = [],
        public readonly int $status = Response::HTTP_INTERNAL_SERVER_ERROR,
        public readonly string $message = 'An error has occured'
    ) {
    }
}
