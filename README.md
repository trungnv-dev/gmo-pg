# esc-gmo-pg

Core Gmo Payment Services

## Installation

Require this package with composer.

```shell
composer require gmo-ecs/gmo-pg
```

Copy the package config to your local config with the publish command

```shell
php artisan vendor:publish --provider="Ecs\GmoPG\Providers\GmoPGServiceProvider"
```

Setup `.env`

```php
SITE_ID="{$SITE_ID}"
SITE_PASS="{$SITE_PASS}"
SHOP_ID="{$SHOP_ID}"
SHOP_PASS="{$SHOP_PASS}"
GMO_PAYMENT_URL="{$GMO_PAYMENT_URL}"
```

## Example

1. Call function

```php
use Ecs\GmoPG\Services\MemberCardService;

resolve(MemberCardService::class)
    ->searchCard([
        'MemberID' => $gmoMemberId
    ]);
```

2. If success

```php
[
    "CardSeq" => "0|1"
    "DefaultFlag" => "0|0"
    "CardName" => "|"
    "CardNo" => "411*********1113|411*********1111"
    "Expire" => "2305|2305"
    "HolderName" => "NGUYEN VAN A|NGUYEN VAN A"
    "DeleteFlag" => "0|0"
]
```

3. If errors

```php
[
    "ErrCode" => "E01|E01"
    "ErrInfo" => "E01390002|E01240002"
    "errors" => array:2 [
        "E01390002" => "指定されたサイト ID と会員 ID の会員が存在しません。"
        "E01240002" => "指定されたカードが存在しません。"
    ]
]
```

## Note

1. You can change or add new error messages in the file `resources/lang/ja/gmopg-errors.php`
2. You can add new configuration about gmopg in file `config/gmopg.php`
