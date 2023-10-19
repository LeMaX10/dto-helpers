# PHP Laravel DTO Helpers

This collection trait helpers DTO class Helpers.

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
    use AsArray, AsJson, AsJsonSerialize;
    
    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new ExampleJsonSerializeDTO(key: 'test1', value: 'value1');
var_dump($dto->toArray()); // (array) ['key' => 'test1', 'value' => 'value1']
var_dump($dto->toJson()); // (string) {key: "test1", value: "value1"}
var_dump(json_encode($dto)); // (string) {key: "test1", value: "value1"}
```
