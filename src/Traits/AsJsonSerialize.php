<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Traits;

use LeMaX10\DtoHelpers\Exceptions\ClassNotImplementInterfaceException;

trait AsJsonSerialize
{
    public function jsonSerialize()
    {
        if (!is_a($this, \JsonSerializable::class)) {
            throw new ClassNotImplementInterfaceException(static::class, \JsonSerializable::class);
        }

        if (is_a($this, Arrayable::class)) {
            return $this->toArray();
        }

        return $this;
    }
}
