<?php

namespace App\Infrastructure\Http\Listener;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Serializer\SerializerInterface;

class JsonResponseListener
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function handle(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();

        if ($result instanceof Response) {
            return;
        }

        $request = $event->getRequest();

        if (null !== $result) {
            $response = JsonResponse::create();
            $response->setJson($this->serializer->serialize($result, 'json'));
            $response->setStatusCode($request->isMethod('POST') ? Response::HTTP_CREATED : Response::HTTP_OK);
        } else {
            $response = Response::create();
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        }

        $event->setResponse($response);
    }
}
