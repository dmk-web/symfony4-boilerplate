<?php

namespace App\Infrastructure\Http\Listener\JwtToken;


use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTExpiredListener
{
    public function handle(JWTExpiredEvent $event)
    {
        $response = JsonResponse::create();
        $response->setStatusCode(JsonResponse::HTTP_UNAUTHORIZED);
        $response->setData([
            'type' => 'JWT_TOKEN_IS_EXPIRED',
            'data' => 'JWT token is expired'
        ]);

        $event->setResponse($response);
    }
}