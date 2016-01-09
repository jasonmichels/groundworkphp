### GroundworkPHP - PHP 7 micro framework

### Introduction
GroundworkPHP is a PHP 7 micro framework

### Example
```php
declare(strict_types=1);
require('../vendor/autoload.php');

use GroundworkPHP\Framework\App;
use GroundworkPHP\Framework\Http\Router;
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

GroundworkPHP is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

Authors
----
- Jason Michels
