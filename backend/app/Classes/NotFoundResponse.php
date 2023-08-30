<?php

namespace App\Classes;

use App\Classes\Response as BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class NotFoundResponse extends BaseResponse
{
    public function __construct(
        public readonly mixed $data = [],
        public readonly string $message = 'Data was not found',
        public readonly int $status = Response::HTTP_NOT_FOUND
    ) {
    }
}
