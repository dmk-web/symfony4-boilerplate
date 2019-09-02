<?php

namespace App\Infrastructure\Http\Listener;

use App\Application\Exception\HandledException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class HandledExceptionListener
{
    public function handle(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!$exception instanceof HandledException) {
            return;
        }

        $response = JsonResponse::create();
        $response->headers->set('X-Response-Type', 'FAILURE');

        $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);

        $response->setData([
            'type' => $exception::getType(),
            'data' => $exception->getMessage()
        ]);

        $event->setResponse($response);
        $event->allowCustomResponseCode();
    }
}
