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

Converts your DTO to an array.  
*Requires:* Implements `Illuminate\Contracts\Support\Arrayable`.

```php
use LeMaX10\DtoHelpers\Traits\AsArray;
use Illuminate\Contracts\Support\Arrayable;

class MyData implements Arrayable
{
    use AsArray;

    public function __construct(
        public string $key,
        public string $value
    ) {}
}

$dto = new MyData(key: 'test1', value: 'value1');

dump($dto->toArray());
// Output: ['key' => 'test1', 'value' => 'value1']
```

---

### AsJson

Converts your DTO to a JSON string.  
*Requires:* Implements `Illuminate\Contracts\Support\Jsonable`.

```php
use LeMaX10\DtoHelpers\Traits\AsJson;
use Illuminate\Contracts\Support\Jsonable;

class MyData implements Jsonable
{
    use AsJson;
    // ...
}

$dto = new MyData(key: 'test1', value: 'value1');

dump($dto->toJson());
// Output: '{"key":"test1","value":"value1"}'
```

---

### AsJsonSerialize

Enables JSON serialization with `json_encode()`.  
*Requires:* Implements `JsonSerializable`.

```php
use LeMaX10\DtoHelpers\Traits\AsJsonSerialize;
use JsonSerializable;

class MyData implements JsonSerializable
{
    use AsJsonSerialize;

    // ...
}

$dto = new MyData(key: 'test1', value: 'value1');

dump(json_encode($dto));
// Output: '{"key":"test1","value":"value1"}'
```

---

### AsCloneable

Clones a DTO while allowing property overrides.  
*Requires:* A compatible interface (e.g., `Illuminate\Contracts\Support\Arrayable`).

```php
use LeMaX10\DtoHelpers\Traits\AsArray;
use LeMaX10\DtoHelpers\Traits\AsCloneable;
use Illuminate\Contracts\Support\Arrayable;

class MyData implements Arrayable
{
    use AsArray, AsCloneable;

    // ...
}

$dto = new MyData(key: 'test1', value: 'value1');

dump($dto->toArray());
// Output: ['key' => 'test1', 'value' => 'value1']

$clone = $dto->clone(['key' => 'test2']);

dump($clone->toArray());
// Output: ['key' => 'test2', 'value' => 'value1']
```

---

### Eloquent Model Casts

Use your DTO as a custom cast in an Eloquent model.

```php
use LeMaX10\DtoHelpers\Casts\AsDto;
use Illuminate\Database\Eloquent\Model;

class ExampleModel extends Model
{
    protected $casts = [
        'dto' => AsDto::class . ':' . MyData::class,
    ];
    
    // OR
    
    public function casts()
    {
        return [
           'dto' => AsDto::cast(MyData::class),
        ];
    }
}

$model = ExampleModel::find(1);

dump($model->dto);
// Output: instance of MyData
```

## Contributing

Thank you for considering contributing to the DTO Helpers package! 

## License

The DTO Helpers package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).