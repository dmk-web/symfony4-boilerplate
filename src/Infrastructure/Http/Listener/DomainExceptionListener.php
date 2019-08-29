<?php

namespace App\Infrastructure\Http\Listener;


use App\Domain\Common\Exceptions\RepositoryException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class DomainExceptionListener
{
    public function handle(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        $supports = is_subclass_of($exception, RepositoryException::class);

        if (!$supports) {
            return;
        }

        $event->allowCustomResponseCode();

        $response = JsonResponse::create();
        $response->setStatusCode(Response::HTTP_BAD_REQUEST);
        $response->setData([
            'type' => 'DOMAIN_ERROR',
            'data' => $exception->getMessage()
        ]);

        $event->setResponse($response);
    }
}
