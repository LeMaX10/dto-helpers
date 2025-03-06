<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Contracts;

interface Makeable
{
    public static function make(...$arguments): static;
}