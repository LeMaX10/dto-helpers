<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Traits;

use LeMaX10\DtoHelpers\Exceptions\ClassNotImplementInterfaceException;

trait AsJsonSerialize
{
    public function jsonSerialize()
    {
        if (!$this instanceof \JsonSerializable) {
            throw new ClassNotImplementInterfaceException(static::class, \JsonSerializable::class);
        }

        if ($this instanceof Arrayable) {
            return $this->toArray();
        }

        return $this;
    }
}
