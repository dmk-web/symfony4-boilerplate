<?php

namespace App\Infrastructure\Http\Resolver;


use App\Application\Exception\UnresolvableArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Throwable;

class QueryResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return $request->query->has($argument->getName());
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $name = $argument->getName();
        $type = $argument->getType();
        $value = $request->query->get($name);

        if ($value === null && !$argument->isNullable()) {
            throw UnresolvableArgumentException::nullArgument($name);
        }

        try {
            yield $value;
        } catch (Throwable $e) {
            throw UnresolvableArgumentException::cannotResolveAttribute($name, $type, $e);
        }
    }
}
