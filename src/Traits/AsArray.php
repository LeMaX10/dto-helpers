<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Traits;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use LeMaX10\DtoHelpers\Exceptions\ClassNotImplementInterfaceException;

/**
 *
 */
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
            $item[$key] = match(true) {
                $value instanceof Arrayable, $value instanceof Collection => $value->toArray(),
                $value instanceof \BackedEnum => $value->value,
                $value instanceof \UnitEnum => $value->name,
                $value instanceof Jsonable => $value->toJson(),
                default => $value
            };
        }

        return $item;
    }

    /**
     * @param array|string $keys
     * @return array
     * @throws ClassNotImplementInterfaceException
     */
    public function only(array|string $keys): array
    {
        return Arr::only($this->toArray(), $keys);
    }

    /**
     * @param array|string $keys
     * @return array
     * @throws ClassNotImplementInterfaceException
     */
    public function except(array|string $keys): array
    {
        return Arr::except($this->toArray(), $keys);
    }
}
