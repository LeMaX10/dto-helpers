<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Exceptions;

class ClassNotImplementInterfaceException extends \Exception
{
    public function __construct(string $class, string $contract)
    {
        $this->message = sprintf('Class [%s] must implemented [%s] interface', $class, $contract);
    }
}
