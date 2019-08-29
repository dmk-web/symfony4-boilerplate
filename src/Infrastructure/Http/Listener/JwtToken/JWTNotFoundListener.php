<?php

namespace App\Infrastructure\Http\Listener\JwtToken;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTNotFoundListener
{
    public function handle(JWTNotFoundEvent $event)
    {
        $response = JsonResponse::create();
        $response->setStatusCode(JsonResponse::HTTP_UNAUTHORIZED);
        $response->setData([
            'type' => 'JWT_TOKEN_NOT_PROVIDED',
            'data' => "JWT token is not provided in header with name 'Authorization'."
        ]);

        $event->setResponse($response);
    }
}