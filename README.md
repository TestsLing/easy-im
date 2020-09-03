<h1 align="left"><a href="https://www.easyim.cn">EasyIM</a></h1>

📦 基于腾讯IM的php-sdk


[![Test Status](https://github.com/TestsLing/easy-im/workflows/Test/badge.svg)](https://github.com/TestsLing/easy-im/actions)
[![Lint Status](https://github.com/TestsLing/easy-im/workflows/Lint/badge.svg)](https://github.com/TestsLing/easy-im/actions)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/TestsLing/easy-im/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/TestsLing/easy-im/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/TestsLing/easy-im/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/TestsLing/easy-im/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/longing/easy-im/v)](//packagist.org/packages/longing/easy-im)
[![Total Downloads](https://poser.pugx.org/longing/easy-im/downloads)](//packagist.org/packages/longing/easy-im)
[![Latest Unstable Version](https://poser.pugx.org/longing/easy-im/v/unstable)](//packagist.org/packages/longing/easy-im)
[![License](https://poser.pugx.org/longing/easy-im/license)](//packagist.org/packages/longing/easy-im)

## Requirement

1. PHP> = 7.2
2. ** [Composer](https://getcomposer.org/) **
3. openssl拓展

## Installation

```shell
$ composer require longing/easy-im:~1.0 -vvv
```
## Usage

基本使用（以服务端为例）:

```php
use EasyIM\Factory;

$options = [
    'sdk_app_id'    => '1400306676',                                                        // sdkAppId
    'secret'        => '3e373d1ef02ef192ee26c94760681cdf492b4b7f053fc16504d30a77a028e76d',  // secret
    'identifier'    => 'admin',                                                             // 管理员账号
    'expire'        => 86400,                                                               // 签名过期时间
    // ...
];

$app = Factory::TencentIM($options);
```

[更多](https://www.easyim.cn)

## License

MIT



[![Test Status](https://github.com/TestsLing/easy-im/workflows/Test/badge.svg)](//github.com/TestsLing/easy-im/actions)
[![Lint Status](https://github.com/TestsLing/easy-im/workflows/Lint/badge.svg)](//github.com/TestsLing/easy-im/actions)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/TestsLing/easy-im/badges/quality-score.png?b=master)](//scrutinizer-ci.com/g/TestsLing/easy-im/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/TestsLing/easy-im/badges/coverage.png?b=master)](//scrutinizer-ci.com/g/TestsLing/easy-im/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/longing/easy-im/v)](//packagist.org/packages/longing/easy-im)
[![Total Downloads](https://poser.pugx.org/longing/easy-im/downloads)](//packagist.org/packages/longing/easy-im)
[![Latest Unstable Version](https://poser.pugx.org/longing/easy-im/v/unstable)](//packagist.org/packages/longing/easy-im)
[![License](https://poser.pugx.org/longing/easy-im/license)](//packagist.org/packages/longing/easy-im)
