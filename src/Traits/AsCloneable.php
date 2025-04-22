<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Traits;

use Illuminate\Contracts\Support\Arrayable;
use LeMaX10\DtoHelpers\Contracts\Cloneable;
use LeMaX10\DtoHelpers\Exceptions\ClassNotImplementInterfaceException;

trait AsCloneable
{
    public function clone(...$arguments): static
    {
        if (!is_a($this, Cloneable::class)) {
            throw new ClassNotImplementInterfaceException(static::class, Cloneable::class);
        }

        return new static(...array_merge($this->prepare(), $arguments));
    }

    private function prepare(): array
    {
        $item = [];
        foreach (get_object_vars($this) as $key => $value) {
            $item[$key] = is_a($value, Arrayable::class) ? $value->toArray() : $value;
        }

        return $item;
    }
}
