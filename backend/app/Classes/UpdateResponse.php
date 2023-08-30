<?php

namespace App\Classes;

use App\Classes\Response as BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateResponse extends BaseResponse
{
    public function __construct(
        public readonly mixed $data,
        public readonly string $message = 'Data has been updated',
        public readonly int $status = Response::HTTP_OK
    ) {
    }
}
