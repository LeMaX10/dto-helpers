# PHP Laravel DTO Helpers

This package offers a set of traits to simplify working with DTOs (Data Transfer Objects) in Laravel. It allows you to:

- Convert a DTO to an array using the `AsArray` trait.
- Transform a DTO into a JSON string via the `AsJson` trait.
- Seamlessly serialize a DTO with `json_encode()` using the `AsJsonSerialize` trait.
- Clone a DTO with modified properties through the `AsCloneable` trait.
- Use DTOs as custom casts in Eloquent models.

## Installation

Install the library using Composer:

```bash
composer require lemax10/dto-helpers
```

## Usage

## AsArray
Convert you DTO to Array

Class must implement `Illuminate\Contracts\Support\Arrayable`
```php
<?php
declare(strict_types=1);
namespace Example/Dtos;

use LeMaX10\DtoHelpers\Traits\AsArray;
use Illuminate\Contracts\Support\Arrayable;
 
class readonly ExampleArrayableDTO implements Arrayable
{
    use AsArray;
    
    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new ExampleArrayableDTO(key: 'test1', value: 'value1');
var_dump($dto->toArray()); // (array) ['key' => 'test1', 'value' => 'value1']
```

## AsJson
Convert you DTO to JSON

Class must implement `Illuminate\Contracts\Support\Jsonable`

```php
<?php
declare(strict_types=1);
namespace Example/Dtos;

use Illuminate\Contracts\Support\Jsonable;
use LeMaX10\DtoHelpers\Traits\AsJson;
use Illuminate\Contracts\Support\Arrayable;
 
class readonly ExampleJsonableDTO implements Jsonable
{
    use AsJson;
    
    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new ExampleJsonableDTO(key: 'test1', value: 'value1');
var_dump($dto->toJson()); // (string) {key: "test1", value: "value1"}
```
## AsJsonSerialize
Class modify to json_encode

Class must implement `JsonSerializable`
```php
<?php
declare(strict_types=1);
namespace Example/Dtos;

use LeMaX10\DtoHelpers\Traits\AsJsonSerialize;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
 
class readonly ExampleJsonableDTO implements JsonSerializable
{
    use AsJson;
    
    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new ExampleJsonSerializeDTO(key: 'test1', value: 'value1');
var_dump(json_encode($dto)); // (string) {key: "test1", value: "value1"}
```
## AsCloneable
Class modify to json_encode

Class must implement `Arrayable`
```php
<?php
declare(strict_types=1);
namespace Example/Dtos;

use LeMaX10\DtoHelpers\Traits\AsArray;
use LeMaX10\DtoHelpers\Traits\AsCloneable;
use Illuminate\Contracts\Support\Arrayable;
 
class readonly ExampleCloneableDTO implements Arrayable
{
    use AsArray, AsCloneable;
    
    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new ExampleCloneableDTO(key: 'test1', value: 'value1');
var_dump($dto->toArray()); // (array) ["key" => "test1", "value" => "value1"]

$clone = $dto->clone(['key' => 'test2']);
var_dump($dto->toArray()); // (array) ["key" => "test2", "value" => "value1"]
```

## Laravel Eloquent Model Casts
Laravel AsDto casts

```php
<?php
declare(strict_types=1);
namespace App/Models;

use LeMaX10\DtoHelpers\Casts\AsDto;
use ExampleDto;
 
class ExampleModel extends Model 
{
    ....
    public $casts = [
        'dto' => AsDto::class .':'. ExampleDto::class,
    ];
}

$model = ExampleModel::find(1);
var_dump($model->dto); // (object) ExampleDto
```


## Other examples

```php
<?php
declare(strict_types=1);
namespace Example/Dtos;

use LeMaX10\DtoHelpers\Traits\AsJsonSerialize;
use LeMaX10\DtoHelpers\Traits\AsArray;
use LeMaX10\DtoHelpers\Traits\AsJson;
use JsonSerializable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
 
class readonly ExampleJsonableDTO implements Arrayable, Jsonable, JsonSerializable
{
    use AsArray, AsJson, AsJsonSerialize, AsCloneable;
    
    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new ExampleJsonSerializeDTO(key: 'test1', value: 'value1');
var_dump($dto->toArray()); // (array) ['key' => 'test1', 'value' => 'value1']
var_dump($dto->toJson()); // (string) {key: "test1", value: "value1"}
var_dump(json_encode($dto)); // (string) {key: "test1", value: "value1"}

$clone = $dto->clone(['key' => 'test2']);
var_dump($dto->toArray()); // (array) ['key' => 'test2', 'value' => 'value1']
```
