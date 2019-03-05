<?php

namespace App\Infrastructure\Http\Resolver;


use App\Infrastructure\Exception\ArgumentResolvingException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class RouteValueResolver implements ArgumentValueResolverInterface
{
    private $denormalizer;

    public function __construct(DenormalizerInterface $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return $request->attributes->has($argument->getName());
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $name = $argument->getName();
        $type = $argument->getType();

        try {
            yield $this->denormalizer->denormalize($request->attributes->get($name), $type);
        } catch (\Throwable $e) {
            throw ArgumentResolvingException::cannotResolveAttribute($name, $type, $e);
        }
    }
}
