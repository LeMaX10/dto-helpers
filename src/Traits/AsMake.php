<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Traits;

use LeMaX10\DtoHelpers\Contracts\Makeable;
use LeMaX10\DtoHelpers\Exceptions\ClassNotImplementInterfaceException;

/**
 *
 */
trait AsMake
{
    /**
     * @return static
     */
    public static function make(...$arguments): static
    {
        return new static(...$arguments);
    }
}
