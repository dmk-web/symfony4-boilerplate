<?php

namespace App\Application\Http\Auth;


use App\Application\Cqs\Auth\Command\GetTokenCommand;
use App\Application\Cqs\Auth\Input\TokenInput;
use Symfony\Component\Routing\Annotation\Route;

class TokenController
{
    /**
     * @Route("/token", methods={"POST"})
     */
    public function obtain(GetTokenCommand $command, TokenInput $input)
    {
        return $command->execute($input);
    }
}
