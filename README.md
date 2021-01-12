# jinritemai-sdk

## Install

```
composer require asialong/jinritemai-sdk -vvv
```

# Usage

```php
<?php

$dispatch = new \Asialong\JinritemaiSdk\Doudian([
    'client_id' => 'your-app-key',
    'client_secret' => 'your-secret',
    'service_id' => 'service-id',
    'debug' => true,
    'log' => [
        'name' => 'doudian',
        'file' => __DIR__ . '/doudian.log',
        'level' => 'debug',
        'permission' => 0777,
    ],
]);



```