<?php

namespace App\Infrastructure\Http\Listener;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class RuntimeExceptionListener
{
    public const EXCEPTION = [
        'Infrastructure' => \App\Infrastructure\Exception\RuntimeException::class,
        'Application' => \App\Application\Exception\RuntimeException::class
    ];

    public function handle(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        $supports = false;

        foreach (self::EXCEPTION as $supportedException) {
            $supports = is_subclass_of($exception, $supportedException);
        }

        if (!$supports) {
            return;
        }

        $event->allowCustomResponseCode();

        $response = JsonResponse::create();
        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        $response->setData(['error' => $exception->getMessage()]);

        $event->setResponse($response);
    }
}
