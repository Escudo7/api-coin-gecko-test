## Тестовое задание для Serenity.

## Текст задания:

Разработать и опубликовать на Composer пакет, который будет обеспечивать интеграцию с сервисом https://www.coingecko.com/en/api 

Идея довольно простая: мы устанавливаем пакет из композера, получаем некоторый класс, который позволяет передать ID криптовалюты (например DASH) и взамен получить ответ от API в RAW формате (обычный массив, который в ответ шлет нам CoinGecko) 

## Installation

```bash
$ composer require escudo/api-coin-gecko-test
```

## Usage

```php
use Escudo\CoinGeckoApi;

$api = new CoinGeckoApi('DASH');

$api->getCoin(); //'dash'

$api->getCoinsList();

$api->getData();
$api->getData(['localization' => false]);

$api->getTickers();
$api->getTickers(['order' => 'trust_score_asc ']);

$api->getHistory('30-12-2017');
$api->getHistory('30-12-2017', ['localization' => false]);

$api->getMarketChart('usd', 1);

$api->getMarketChartRange('usd', '1392577232', '1422577232');

$api->getStatusUpdates();
$api->getStatusUpdates(['per_page' => 5, 'page' => 1]);

$api->getOhls('usd', 1);

$api->setCoin('0cash');
$api->getCoin(); //'0cash'
```
