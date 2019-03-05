<?php

namespace App\Infrastructure\Http\Listener;


use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class RuntimeExceptionListener
{
    public function handle(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $response = new Response();
        if ($exception instanceof RuntimeException) {
            $response = JsonResponse::create();
            $response->setStatusCode(Response::HTTP_BAD_REQUEST);
            $response->setData(['message' => $exception->getMessage()]);
        }
        $event->setResponse($response);
    }
}
