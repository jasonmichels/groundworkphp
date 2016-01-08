### Groundwork - PHP 7 framework

### Introduction
Groundwork is a PHP 7 microframework

### Example
```php
declare(strict_types=1);
require('../vendor/autoload.php');

use Groundwork\App;
use Groundwork\Http\Router;
use Symfony\Component\HttpFoundation\JsonResponse;

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$app = new App($uri, $httpMethod, new Router());

$app->get('/', function (JsonResponse $response) {
    $response->setData(['data' => ['stuff' => 'awesome']]);
    return $response;
});

$app->run();
```

### Testing
```sh
$ phpunit
```
- Be Awesome!

### Language
 - PHP 7

### License

Groundwork is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

Authors
----
- Jason Michels
