<?php

namespace App\Infrastructure\Http\Resolver;


use App\Application\Security\LoggedUserProvider;
use App\Domain\User\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class LoggedUserResolver implements ArgumentValueResolverInterface
{
    private $loggedUserProvider;

    public function __construct(LoggedUserProvider $provider)
    {
        $this->loggedUserProvider = $provider;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return $argument->getType() === User::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        yield $this->loggedUserProvider->provideEntity();
    }
}
