<?php

namespace App\Classes;

use App\Classes\Response as BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreResponse extends BaseResponse
{
    public function __construct(
        public readonly mixed $data,
        public readonly int $status = Response::HTTP_CREATED,
        public readonly string $message = 'Data has been stored'
    ) {
    }
}
