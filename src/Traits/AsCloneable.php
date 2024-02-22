<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Traits;

use Illuminate\Contracts\Support\Arrayable;
use LeMaX10\DtoHelpers\Exceptions\ClassNotImplementInterfaceException;

trait DtoClonable
{
    public function clone(array $arguments): static
    {
        if (!$this instanceof Arrayable) {
            throw new ClassNotImplementInterfaceException(static::class, Arrayable::class);
        }

        return new static(...array_merge($this->toArray(), $arguments));
    }
}