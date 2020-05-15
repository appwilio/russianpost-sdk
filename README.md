<h1 align="center">SDK для <a href="https://www.pochta.ru/support/business/api">бизнес-сервисов</a> Почты России</h1>

<p align="center">
    <a href="https://packagist.org/packages/appwilio/russianpost-sdk"><img src="https://img.shields.io/packagist/v/appwilio/russianpost-sdk.svg?style=flat" alt="Latest Version on Packagist" /></a>
    <a href="https://github.com/appwilio/russianpost-sdk/actions?workflow=tests"><img src="https://github.com/appwilio/russianpost-sdk/workflows/tests/badge.svg" alt="Testing" /></a>
    <a href="https://scrutinizer-ci.com/g/appwilio/russianpost-sdk"><img src="https://img.shields.io/scrutinizer/g/appwilio/russianpost-sdk.svg?style=flat" alt="Quality Score" /></a>
    <a href="https://scrutinizer-ci.com/g/appwilio/russianpost-sdk/?branch=master"><img src="https://img.shields.io/scrutinizer/coverage/g/appwilio/russianpost-sdk/master.svg?style=flat" alt="Code Coverage" /></a>
    <a href="https://styleci.io/repos/101485954"><img src="https://github.styleci.io/repos/101485954/shield?style=flat" alt="StyleCI" /></a>
    <a href="https://packagist.org/packages/appwilio/russianpost-sdk"><img src="https://poser.pugx.org/appwilio/russianpost-sdk/downloads?format=flat" alt="Total Downloads"></a>
    <a href="https://raw.githubusercontent.com/appwilio/russianpost-sdk/master/LICENSE.md"><img src="https://poser.pugx.org/appwilio/russianpost-sdk/license?format=flat" alt="License MIT"></a>
</p>

## Содержание
- [Установка](#установка)
- [Трекинг](#трекинг)
  - [x] [Единичный доступ](#единичный-доступ)
    - [x] информация о наложенном платеже
  - [x] [Пакетный доступ](#пакетный-доступ)
- [Отправка](#отправка)
  - [x] [Расчёт стоимости пересылки](#расчёт-стоимости-пересылки)
  - [x] Получение баланса
  - [x] Нормализация и валидация данных
    - [x] [ФИО](#нормализация-ФИО)
    - [x] [Адреса](#нормализация-адресов)
    - [x] [Телефоны](#нормализация-телефонов)
    - [x] [Проверка благонадёжности получателя](#проверка-благонадёжности-получателя)
  - [x] [Документы](#документы)
    - [x] [Форма Ф7п для заказа](#форма-Ф7п-для-заказа)
    - [x] [Форма Ф112ЭК для заказа](#форма-Ф112ЭК-для-заказа)
    - [x] [Пакет документов для заказа (до формирования партии)](#пакет-документов-для-заказа-(до-формирования-партии))
    - [x] [Пакет документов для заказа (после формирования партии)](#пакет-документов-для-заказа-(после-формирования-партии))
    - [x] [Пакет документов для партии](#пакет-документов-для-партии)
    - [x] [Акт осмотра содержимого партии](#акт-осмотра-содержимого-партии)
    - [x] [Форма Ф103 для партии](#форма-Ф103-для-партии)
    - [x] [Генерация возвратного ярлыка на одной печатной странице](#возвратный-ярлык)
    - [x] Подготовка и отправка электронной формы Ф103 для партии
  - [ ] Настройки пользователя
  - [ ] Заказы
    - [x] Создание
    - [x] Поиск по идентификатору магазина
    - [x] Поиск по идентификатору Почты России
    - [ ] Редактирование
    - [x] Удаление
    - [ ] Возврат в «Новые»
  - [ ] Партии
    - [ ] Создание партии заказов
    - [ ] Изменение дня отправки партии в ОПС
    - [ ] Перенос заказов в партию
    - [ ] Добавление заказов в партию
    - [ ] Удаление заказов из партии
    - [x] Запрос данных о заказах в партии
    - [x] Поиск партии по наименованию
    - [x] Поиск всех партий
    - [x] Поиск заказов по ШПИ
    - [x] Поиск заказа по идентификатору Почты России
  - [ ] Архив
    - [ ] Запрос данных о партиях
    - [ ] Перевод партии в архив
    - [ ] Возврат партии из архива
  - [ ] Поиск ОПС
    - [x] По индексу
    - [x] По адресу
    - [x] По координатам
    - [x] Поиск индексов в населённом пункте
    - [x] Почтовые сервисы ОПС
    - [x] Почтовые сервисы ОПС по идентификатору группы сервисов
    - [x] Выгрузка из паспорта ОПС
  - [ ] Долгосрочное хранение
    - [ ] Запрос данных о заказах

> Работа с API пакетного трекинга и API отправки возможна только при наличии договора с Почтой России.
>
> Работа с API единичного трекинга возможна как с договором, так и после простой [регистрации](https://tracking.pochta.ru) (но с лимитом — 100 запросов в сутки).

## Установка

> Минимальные требования — PHP 7.1+, ext-soap, ext-json.

Для установки используйте менеджер пакетов [Composer](https://getcomposer.org/):
```bash
composer require appwilio/russianpost-sdk
```

При использовании фреймворка [Laravel](https://laravel.com/) SDK автоматически регистрирует доступные сервисы.

## Логирование

Для логирования запросов и ответов можно подключить любой логгер, реализующий стандарт [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md), например, [Monolog](https://github.com/Seldaek/monolog):
```php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = (new Logger('pochta.ru'))
    ->pushHandler(new StreamHandler('path/to/your.log', Logger::INFO));

// SingleAccessClient, PacketAccessClient, DispatchingClient
$client->setLogger($log);
```

В случае использования фреймворка [Laravel](https://laravel.com/) следует добавить логгер в контейнер под именем `appwilio.russianpost.logger`: 
```php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$this->app->singleton('appwilio.russianpost.logger', static function () {
    return (new Logger('pochta.ru'))
        ->pushHandler(new StreamHandler('path/to/your.log', Logger::INFO));
});
```

## Трекинг

[Документация](https://tracking.pochta.ru/specification)

### Конфигурация в Laravel

Добавьте следющие ключи в `services.php`:
```php
// ...
'russianpost' => [
    'tracking' => [
        'login' => \env('RUSSIAN_POST_TRACKING_LOGIN'),
        'password' => \env('RUSSIAN_POST_TRACKING_PASSWORD'),
    ],
]
// ...
```

Не забудьте перегенерировать кэш настроек, если они были закэшированы!


### Единичный доступ

```php
use Appwilio\RussianPostSDK\Tracking\SingleAccessClient;

$tracker = new SingleAccessClient($login = 'login', $password = 'secret');
```

> Если инфрмации по ШПИ (трек-комеру) не найдено, то выбрасывается исключение
>`Appwilio\RussianPostSDK\Tracking\Exceptions\SingleAccessException` с соответствующим сообщением.

#### Получение данных по ШПИ (трек-комеру)
```php
$response = $tracker->getTrackingEvents('29014562148754');
```

Объект `$response` реализует интерфейс `\IteratorAggregate`, поэтому его можно сразу перебирать в цикле:
```php
foreach ($response as $events) {
    $parameters = $events->getOperationParameters();
    
    echo $parameters->getOperationId();
    echo $parameters->getAttributeId();
    echo $parameters->getPerformedAt()->format('d.m.Y в h:i:s'); // 17.09.2019 в 17:20:48
}
```

#### Получение информации о наложенном платеже по ШПИ (трек-комеру)
```php
$response = $tracker->getCashOnDeliveryEvents('29014562148754');
```

Объект `$response` реализует интерфейс `\IteratorAggregate`, поэтому его можно сразу перебирать в цикле:
```php
foreach ($response as $event) {
    $parameters = $event->getOperationParameters();
    
    echo $parameters->getTransferNumber();
    echo $parameters->getPayment(); // 7410
    echo $parameters->getPerformedAt()->format('d.m.Y в h:i:s'); // 17.09.2019 в 17:20:48
}
```

### Пакетный доступ

```php
use Appwilio\RussianPostSDK\Tracking\PacketAccessClient;

$tracker = new PacketAccessClient($login = 'login', $password = 'secret');
```

#### Получение данных по ШПИ (трек-комеру)
```php
$ticket = $tracker->getTicket(['29014562148754', 'RA325487125CN']); // максимум 3 000 треков
```

Рекомендуется подождать 15 минут перед запросом информации.

```php
$response = $tracker->getTrackingEvents($ticket->getId());

echo $response->getPreparedAt()->format('d.m.Y в h:m:s');
```

Объект `$response` реализует интерфейс `\IteratorAggregate`, поэтому его можно сразу перебирать в цикле:
```php
foreach ($response as $item) {
    echo $item->getBarcode();
    
    foreach ($item as $events) {
        echo $events->getOperationId();
        echo $events->getAttributeId();
        echo $events->getPerformedAt()->format('d.m.Y в h:m:s'); // 17.09.2019 в 17:20:48
    }
}
```

## Отправка

[Документация](https://otpravka.pochta.ru/specification)

### Конфигурация
```php
use GuzzleHttp\Client as GuzzleClient;
use Appwilio\RussianPostSDK\Dispatching\DispatchingClient;

$dispatching = new DispatchingClient(
    $login = 'login', $password = 'secret', $token = 'QWERTY', new GuzzleClient()
);
```

#### Конфигурация в Laravel

Добавьте следющие ключи в `services.php`:
```php
// ...
'russianpost' => [
    'dispatching' => [
        'token' => \env('RUSSIAN_POST_DISPATCHING_TOKEN'),
        'login' => \env('RUSSIAN_POST_TDISPATCHING_LOGIN'),
        'password' => \env('RUSSIAN_POST_DISPATCHING_PASSWORD'),
    ],
]
// ...
```

Не забудьте перегенерировать кэш настроек, если они были закэшированы!

### Расчёт стоимости пересылки
```php
use Appwilio\RussianPostSDK\Dispatching\Enum\MailType;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailCategory;
use Appwilio\RussianPostSDK\Dispatching\Enum\MailEntryType;
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CalculationRequest;

$response = $dispatching->services->calculate(
    CalculationRequest::create('123456', 200)
        ->ofMailType(MailType::PARCEL_POSTAL())
        ->ofMailCategory(MailCategory::ORDINARY())
        ->ofEntriesType(MailEntryType::GOODS())
        ->fragile()
        ->withSmsNotice()
);

echo $response->getTotal()->getRate();
echo $response->getTotal()->getVAT(); // НДС
```

### Нормализация и валидация данных

#### Нормализация ФИО
```php
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeFioRequest;

$response = $dispatching->services->normalizeFio(
    NormalizeFioRequest::one('иванов иван иванович')
);

if ($response[0]->isUseful()) {
    echo $response[0]->getFirstName().' '.$response[0]->getLastName(); // Иван Иванов
}
```

#### Нормализация адресов
```php
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizeAddressRequest;

$response = $dispatching->services->normalizeAddress(
    NormalizeAddressRequest::one('Москва варшавское шоссе 37-45')
);
```

#### Нормализация телефонов
```php
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\NormalizePhoneRequest;

$response = $dispatching->services->normalizePhone(NormalizePhoneRequest::one('89001234567'));
```

#### Проверка благонадёжности получателя
```php
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CheckRecipientRequest;

$response = $dispatching->services->checkRecipient(
    CheckRecipientRequest::one('Москва, Варшавское шоссе, 37-45', 'Иванов Иван Иванович', '+7 123 456-78-90')
);

$response[0]->isFraud(); // ненадёжный
$response[0]->isReliable(); // надёжный
```

```php
use Appwilio\RussianPostSDK\Dispatching\Endpoints\Services\Requests\CheckRecipientRequest;

$request = CheckRecipientRequest::create();
$request->addRecipient('123456 Москва, Варшавское шоссе, 37-45', 'Иванов Иван Иванович', '+7 123 456-78-90');

$response = $dispatching->services->checkRecipient($request);

foreach ($response as $recipient) {
    echo $recipient->getAddress.': '.$recipient->isReliable();
}
```

### Документы
```php
$file = $dispatching->documents->orderF7Form('12345678');

echo $file->getClientFilename(); // f7p.pdf

// Сохранение
$file->moveTo("storage/printforms/12345678-{$file->getClientFilename()}");

// Перенаправление в браузер (Laravel)
return \response()->streamDownload(staticfunction () use ($file) {
    (string) $file->getStream();
}, $file->getClientName(), ['Content-Type' => $file->getClientMediaType()]);
```

#### Форма Ф7п для заказа
```php
use Appwilio\RussianPostSDK\Dispatching\Enum\PrintType;

$pdf = $dispatching->documents->orderF7Form(
    '12345678', new \DateTime('2019-01-01'), PrintType::PAPER()
);
```

#### Форма Ф112ЭК для заказа
```php
$pdf = $dispatching->documents->orderF112Form('12345678', new \DateTime('2019-01-01'));
```

#### Пакет документов для заказа (до формирования партии)
```php
$zip = $dispatching->documents->orderFormsBundleBacklog('12345678', new \DateTime('2019-01-01'));
```

#### Пакет документов для заказа (после формирования партии)
```php
use Appwilio\RussianPostSDK\Dispatching\Enum\PrintType;

$zip = $dispatching->documents->orderFormBundle(
    '12345678', new \DateTime('2019-01-01'), PrintType::THERMO()
);
```

#### Пакет документов для партии
```php
$zip = $dispatching->documents->batchFormBundle('87654321');
```

#### Акт осмотра содержимого партии
```php
$pdf = $dispatching->documents->batchCheckingForm('87654321');
```

#### Форма Ф103 для партии
```php
$pdf = $dispatching->documents->batchF103Form('87654321');
```

#### Возвратный ярлык
```php
use Appwilio\RussianPostSDK\Dispatching\Enum\PrintType;

$pdf = $dispatching->documents->easyReturnForm('29014562148754', PrintType::THERMO());
```

## Запуск тестов

```
$ vendor/bin/phpunit
```
## Авторы

- [greabock](https://github.com/greabock)
- [JhaoDa](https://github.com/jhaoda)

## Лиценция

Данный SDK распространяется под лицензией [MIT](http://opensource.org/licenses/MIT).
