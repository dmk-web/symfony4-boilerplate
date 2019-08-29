<?php

namespace App\Infrastructure\Http\Listener;


use App\Application\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ValidationExceptionListener
{
    public function handle(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!$exception instanceof ValidationException) {
            return;
        }

        $response = JsonResponse::create();
        $response->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->setData([
            'type' => 'VALIDATION_ERROR',
            'data' => $exception->getMessages()
        ]);

        $event->setResponse($response);
        $event->allowCustomResponseCode();
    }
}
