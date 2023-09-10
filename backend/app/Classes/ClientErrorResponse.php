<?php

namespace App\Classes;

use App\Classes\Response as BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class ClientErrorResponse extends BaseResponse
{
    public function __construct(
        public readonly mixed $data = [],
        public readonly string $message = 'Your client sent wrong information',
        public readonly int $status = Response::HTTP_BAD_REQUEST
    ) {
    }
}
