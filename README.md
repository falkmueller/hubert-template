Hubert Template Extension
======

## Installation

Hubert is available via Composer:

```json
{
    "require": {
        "falkm/hubert-template": "1.*"
    }
}
```

## Usage

Create an index.php file with the following contents:

```php
<?php

require 'vendor/autoload.php';

$app = new hubert\app();

$config = array(
    "factories" => array(
         "template" => array(hubert\extension\template\factory::class, 'get')
        ),
    "config" => array(
        "display_errors" => true,
        "template" => array(
               "path" => __dir__.'/templates',
               "fileExtension" => "phtml",
               "extensions" => array(
                   hubert\extension\template\urlExtension::class
               )
            )
        ),
    "routes" => array(
        "home" => array(
            "route" => "/", 
            "method" => "GET|POST", 
            "target" => function($request, $response, $args){
                $container = hubert()->container();     
                $html = $container["template"]->render("index", array("name" => "hubert"));
                $response->getBody()->write($html);
                return $response;
            }
        ),
);

hubert($config);
hubert()->emit(hubert()->run());
```

For more see the example in this repository.

### components

- plates template engine: [league/plates](http://platesphp.com)

## License

The MIT License (MIT). Please see [License File](https://github.com/falkmueller/hubert/blob/master/LICENSE) for more information.