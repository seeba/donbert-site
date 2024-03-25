<?php

declare(strict_types=1);

namespace App\Shared\Application\Validator;

use App\Shared\Application\Service\CanBeValidatedInterface;
use App\Shared\Application\Service\ValidatorInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface as SymfonyValidatorInterface;

final class EntityValidator implements ValidatorInterface
{
    public function __construct(
        private SymfonyValidatorInterface $validator
    ){}
    /**
     * @throws Exception
     */
    public function validate(CanBeValidatedInterface $object) : bool
    {
        $errors = $this->validator->validate($object);
        
        if ($errors->count() > 0) {
            $message = '';
            foreach ($errors as $error) {
                $message .= $error->getMessage();
            }

        throw new Exception($message);
        }

        return true;
    }
}