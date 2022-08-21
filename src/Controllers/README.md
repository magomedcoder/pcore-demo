## Controller

```php
use PCore\Routing\Annotations\Controller;

// @param string $prefix
// @param array $middlewares
// @param array $patterns
#[Controller(prefix: '/')]
```

```php
use PCore\Routing\Annotations\{GetMapping, PostMapping, PutMapping, DeleteMapping, PatchMapping};

// @param string $path
// @param array|string[] $methods
// @param array $middlewares
#[GetMapping(path: '/')]
#[PostMapping(path: '/')]
#[PutMapping(path: '/')]
#[DeleteMapping(path: '/')]
#[PatchMapping(path: '/')]
```

```php
use PCore\HttpMessage\Response;
use PCore\Routing\Annotations\Controller;
use PCore\Routing\Annotations\GetMapping;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

#[Controller(prefix: '/')]
class IndexController
{
    #[GetMapping(path: '/')]
    public function index(ServerRequestInterface $request): ResponseInterface
    {
        $title = $request->get('title');
        // ...
        Response::json(['status' => true]);
    }
}
```

#### Middleware

```php
use App\Middlewares\ExampleMiddleware;

#[Controller(prefix: '/', middlewares: [ExampleMiddleware::class])]

#[GetMapping(path: '/', middlewares: [ExampleMiddleware::class])]
```

---

## Request

```php
use Psr\Http\Message\ServerRequestInterface;
```

#### request <- header

```php
// @param string $name
$request->header('key');
```

#### request <- server

```php
// @param string $name
$request->server('key');
```

#### request <- isMethod

```php
// @param string $method
$request->isMethod('key');
```

#### request <- url

```php
$request->url();
```

#### request <- cookie

```php
// @param string $name
$request->cookie('key');
```

#### request <- isAjax

```php
$request->isAjax();
```

#### request <- isPath

```php
// @param string $path
$request->isPath('key');
```

#### request <- raw

```php
$request->raw();
```

#### request <- get

```php
// @param null|array|string $key
// @param mixed|null $default
$request->get('key');
```

#### request <- post

```php
// @param null|array|string $key
// @param mixed|null $default
$request->post('key');
```

#### request <- input

```php
// @param null|array|string $key
// @param mixed|null $default
// @param array|null $from
$request->input('key');

$request->input(['key', 'key2']);
```

#### request <- isEmpty

```php
// @param array $haystack
// @param $needle
$request->isEmpty('key');
```

#### request <- file

```php
// @param string $field
$request->file('key');
```

#### request <- files

```php
$request->files();
```

#### request <- all

```php
$request->all();
```

#### request <- session

```php
$request->session();
```

#### request <- getRealIp

```php
$request->getRealIp();
```

---

## Response

```php
use PCore\HttpMessage\Response;
```

#### response -> json

```php
// @param bool $success
// @param array|null $data
// @param array|null $errors
// @param int $status
Response::json(['success' => true]);
// { "success": true,"data": { "success": true },"errors": null }
```

#### response -> json

```php
// @param array|ArrayAccess $data
// @param int $status = 200
Response::responseJson(['success' => true]);
// { "success": true }
```

#### response -> cookie

```php
// @param string $name
// @param string $value
// @param int $expires
// @param string $path
// @param string $domain
// @param bool $secure
// @param bool $httponly
// @param string $samesite
Response::withCookie();
```

---

## Validator

```php
use PCore\Validator\Validator;

$validator = new Validator();
$validator->make([
    'title' => 'Привет мир'
], [
    'title' => 'required|max:10|min:5'
]);

// Сработает если проверка не удалась
if($validator->fails()){
    // Возвращает ошибки
    print_r($validator->failed());
}

// Возвращает список проверенных полей
$data = $validator->valid();

// Возвращает первую ошибку
$validator->errors()->first();

// Если вам нужно создать исключение при сбое проверки
$validator->setThrowable(true);
```

####           

```
required
max
min
length
bool
in
regex
confirm
integer
numeric
array
isset
email
```