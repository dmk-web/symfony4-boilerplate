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
        $response = JsonResponse::create();

        if (null !== $result) {
            $response->setJson($this->serialize($result));
            $response->setStatusCode(
                $request->isMethod('POST') ? Response::HTTP_CREATED : Response::HTTP_OK
            );
        } else {
            $response->setStatusCode(Response::HTTP_NO_CONTENT);
        }

        $event->setResponse($response);
    }

    private function serialize($result)
    {
        return sprintf('{"type": "SUCCESS","data": %s}', $this->serializer->serialize($result, 'json'));
    }
}
