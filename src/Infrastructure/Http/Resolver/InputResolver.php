<?php

namespace App\Infrastructure\Http\Resolver;


use App\Application\Exception\ValidationException;
use App\Infrastructure\Exception\ArgumentResolvingException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class InputResolver implements ArgumentValueResolverInterface
{
    private $serializer;
    private $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return strrpos($argument->getType(), 'Input');
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $type = $this->getType($argument);
        $content = $this->getContent($request, $argument);

        if ($argument->isVariadic()) {
            $array = $this->deserialize($type, $content);

            if (!is_array($array)) {
                throw ArgumentResolvingException::notArray($argument->getName(), gettype($array));
            }

            yield from $array;
        } else {
            $item = $this->deserialize($type, $content);

            if (null === $item && !$argument->isNullable()) {
                throw ArgumentResolvingException::nullArgument($argument->getName());
            }

            yield $item;
        }
    }

    private function getType(ArgumentMetadata $argument): string
    {
        return $argument->isVariadic() ? "{$argument->getType()}[]" : $argument->getType();
    }

    private function getContent(Request $request, ArgumentMetadata $argument)
    {
        $content = $request->getContent();

        if (empty($content)) {
            return $argument->isVariadic() ? '[]' : 'null';
        }

        return $content;
    }

    private function deserialize(string $type, string $content)
    {
        $deserialized = $this->serializer->deserialize($content, $type, 'json');

        if (null !== $deserialized) {
            $this->validate($deserialized);
        }

        return $deserialized;
    }

    private function validate($input)
    {
        if (count($errors = $this->validator->validate($input)) > 0) {
            $violationsCollection = iterator_to_array($errors);
            throw new ValidationException(
                array_map(function (ConstraintViolation $violation) {
                    return null !== ($p = $violation->getPropertyPath()) ? "{$p}: {$violation->getMessage()}" : $violation->getMessage();
                }, $violationsCollection)
            );
        }
    }
}
