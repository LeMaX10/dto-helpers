<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Traits;

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
