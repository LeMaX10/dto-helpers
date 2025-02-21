<?php
declare(strict_types=1);

namespace LeMaX10\DtoHelpers\Casts;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Casts\Json;

class AsDto implements Castable
{
    public static function castUsing(array $arguments)
    {
        return new class($arguments) implements CastsAttributes
        {
            protected $arguments;

            public function __construct(array $arguments)
            {
                $this->arguments = $arguments;
            }

            public function get($model, $key, $value, $attributes)
            {
                if (! isset($attributes[$key]) || is_null($attributes[$key])) {
                    return null;
                }

                $data = is_array($attributes[$key]) ? $attributes[$key] : Json::decode($attributes[$key]);

                if (! is_array($data) || !count($data)) {
                    return null;
                }

                $dtoClass = $this->arguments[0];
                return new $dtoClass(...$data);
            }

            public function set($model, $key, $value, $attributes)
            {
                if ($value === null) {
                    return null;
                }

                $dtoClass = $this->arguments[0];
                if (!$value instanceof $dtoClass) {
                    throw new \Exception("The provided value must be an instance of " . $dtoClass);
                }

                return Json::encode($value->toArray());
            }
        };
    }

    public static function cast(string $className): string
    {
        return static::class .':'. $className;
    }
}
