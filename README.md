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


### AsArray

Converts your DTO into an array.

**Requirement:** Your DTO class must implement the `Illuminate\Contracts\Support\Arrayable` interface.

```php
use LeMaX10\DtoHelpers\Traits\AsArray;
use Illuminate\Contracts\Support\Arrayable;

class ExampleArrayableDTO implements Arrayable
{
    use AsArray;

    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new ExampleArrayableDTO(key: 'test1', value: 'value1');

dump($dto->toArray());
// Output: array('key' => 'test1', 'value' => 'value1')
```

### AsJson

Converts your DTO into a JSON string.

**Requirement:** Your DTO class must implement the `Illuminate\Contracts\Support\Jsonable` interface.

```php
use LeMaX10\DtoHelpers\Traits\AsJson;
use Illuminate\Contracts\Support\Jsonable;

class ExampleJsonableDTO implements Jsonable
{
    use AsJson;

    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new ExampleJsonableDTO(key: 'test1', value: 'value1');

dump($dto->toJson());
// Output: string '{"key":"test1","value":"value1"}'
```

### AsJsonSerialize

Enables JSON serialization using `json_encode()`.

**Requirement:** Your DTO class must implement the `JsonSerializable` interface.

```php
use LeMaX10\DtoHelpers\Traits\AsJsonSerialize;
use JsonSerializable;

class ExampleJsonSerializeDTO implements JsonSerializable
{
    use AsJsonSerialize;

    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new ExampleJsonSerializeDTO(key: 'test1', value: 'value1');

dump(json_encode($dto));
// Output: string '{"key":"test1","value":"value1"}'
```

### AsCloneable

Clones a DTO instance while allowing you to override specific properties.

**Requirement:** The DTO class should implement a compatible interface (for example, `Illuminate\Contracts\Support\Arrayable`) to work correctly with the cloning functionality.

```php
use LeMaX10\DtoHelpers\Traits\AsArray;
use LeMaX10\DtoHelpers\Traits\AsCloneable;
use Illuminate\Contracts\Support\Arrayable;

class ExampleCloneableDTO implements Arrayable
{
    use AsArray, AsCloneable;

    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new ExampleCloneableDTO(key: 'test1', value: 'value1');

dump($dto->toArray());
// Output: array('key' => 'test1', 'value' => 'value1')

$clone = $dto->clone(['key' => 'test2']);

dump($clone->toArray());
// Output: array('key' => 'test2', 'value' => 'value1')
```

### Eloquent Model Casts

Use your DTO as a custom cast in an Eloquent model.

```php
use LeMaX10\DtoHelpers\Casts\AsDto;
use Example\Dtos\ExampleDto;
use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model
{
    // ...
    protected $casts = [
        'dto' => AsDto::class . ':' . ExampleDto::class,
    ];
}

$model = ExampleModel::find(1);

dump($model->dto);
// Output: instance of ExampleDto
```
