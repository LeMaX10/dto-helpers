<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Traits;

use Illuminate\Contracts\Support\Arrayable;
use LeMaX10\DtoHelpers\Exceptions\ClassNotImplementInterfaceException;

trait AsArray
{
    /**
     * @return array
     */
    public function toArray()
    {
        if (!$this instanceof Arrayable) {
            throw new ClassNotImplementInterfaceException(static::class, Arrayable::class);
        }

        $item = [];
        foreach (get_object_vars($this) as $key => $value) {
            $item[$key] = $value instanceof Arrayable ? $value->toArray() : $value;
        }

        return $item;
    }
}
