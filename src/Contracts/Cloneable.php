<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Contracts;

interface Cloneable
{
    public function clone(...$arguments): static;
}