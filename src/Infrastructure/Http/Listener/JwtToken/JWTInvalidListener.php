<?php

namespace App\Infrastructure\Http\Listener\JwtToken;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTInvalidListener
{
    public function handle(JWTInvalidEvent $event)
    {
        $exception = $event->getException();

        $response = JsonResponse::create();
        $response->setStatusCode(JsonResponse::HTTP_UNAUTHORIZED);
        $response->setData([
            'type' => 'JWT_TOKEN_IS_INVALID',
            'data' => "Token parsing failure: '{$exception->getMessage()}'."
        ]);

        $event->setResponse($response);
    }
}