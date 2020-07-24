<h1 align="left"><a href="https://www.easyim.cn">EasyIM</a></h1>

📦 基于腾讯IM的php-sdk

## Requirement

1. PHP> = 7.2
2. ** [Composer](https://getcomposer.org/) **
3. openssl拓展

## Installation

```shell
$ composer require "longing/easy-im" -vvv
```
## Usage

基本使用（以服务端为例）:

```php
use EasyIM\Factory;

$options = [
    'app_id'    => 'wx3cf0f39249eb0exxx',
    'secret'    => 'f1c242f4f28f735d4687abb469072xxx',
    // ...
];

$app = Factory::TencentIM($options);
```

## License

MIT
