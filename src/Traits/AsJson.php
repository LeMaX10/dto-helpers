<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Traits;

use Illuminate\Contracts\Support\Jsonable;
use LeMaX10\DtoHelpers\Exceptions\ClassNotImplementInterfaceException;

trait AsJson
{
    public function toJson($options = 0): string
    {
        if (!is_a($this, Jsonable::class)) {
            throw new ClassNotImplementInterfaceException(static::class, Jsonable::class);
        }

        return json_encode($this, $options);
    }
}
