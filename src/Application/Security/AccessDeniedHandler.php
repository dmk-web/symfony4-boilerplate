<?php

namespace App\Application\Security;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    public function handle(Request $request, AccessDeniedException $exception)
    {
        $message = $exception->getMessage();

        $response = JsonResponse::create();
        $response->setStatusCode(JsonResponse::HTTP_FORBIDDEN);
        $response->setData([
            'type' => 'ACCESS_DENIED',
            'data' => !empty($message) ? $message : 'You have low permissions'
        ]);

        return $response;
    }
}