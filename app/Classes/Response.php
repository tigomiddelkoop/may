<?php

namespace App\Classes;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Response implements Responsable
{
    public function __construct(
        public readonly mixed $data,
        public readonly int $status = SymfonyResponse::HTTP_OK,
        public readonly string $message = '',
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                'message' => $this->message,
                //                'code' => 'MAY-2000',
                'data' => $this->data,
            ],
            status: $this->status
        );
    }
}
