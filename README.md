# SDK для Почты России

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/appwilio/russianpost-sdk/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/appwilio/russianpost-sdk/?branch=master)
[![Total Downloads](https://poser.pugx.org/appwilio/russianpost-sdk/downloads)](https://packagist.org/packages/appwilio/russianpost-sdk)
[![Latest Stable Version](https://poser.pugx.org/appwilio/russianpost-sdk/version)](https://packagist.org/packages/appwilio/russianpost-sdk)
[![License](https://poser.pugx.org/appwilio/russianpost-sdk/license)](https://packagist.org/packages/appwilio/russianpost-sdk)

### Это будет самое полное SDK, умеющее работать со всеми API pochta.ru

Возможности:

- [трекинг](https://tracking.pochta.ru/specification)
  - [x] единичный трекинг почтовых отправлений
    - [x] информация о наложенном платеже почтового отправления
  - [x] пакетный трекинг почтовых отправлений
- [отправка](https://otpravka.pochta.ru/specification)
  - [ ] расчёт стоимости отправки
  - [ ] нормализация и валидация данных: ФИО, адреса, телефоны
  - [ ] работа с единичными заказами и их партиями
  - [ ] генерация печатных форм

> Работа с API возможна только при наличии договора с Почтой России (кроме единичного трекинга, где без договора лимит 100 запросов в сутки).

## Установка

> Минимальные требования — PHP 7.1+, SOAP.

```bash
composer require appwilio/russianpost-sdk
```

## Использование

Единичный доступ:
```php
$tracker = new SingleAccessClient($login, $password);

$response = $tracker->getTrackingEvents('29014562148754');

foreach ($response->getOperations() as $operation) {
    $parameters = $operation->getOperationParameters();
    
    echo $parameters->getOperationId();
    echo $parameters->getAttributeId();
    echo $parameters->getPerformedAt();
}
```

Пакетный доступ:
```php
$tracker = new PacketAccessClient($login, $password);

$ticket = $tracker->getTicket(['29014562148754', 'RA325487125CN']); // максимум 3 000 треков

// рекомендуется подождать 15 минут перед запросом информации по билету

$response = $tracker->getTrackingEvents($ticket->getId());

foreach ($response->getEvents() as $event) {
    echo $event->getBarcode();
    
    foreach ($event->getOperations as $operation) {
        echo $operation->getOperationId();
        echo $operation->getAttributeId();
        echo $operation->getPerformedAt();
    }
}
```

## Авторы

- [greabock](https://github.com/greabock)
- [JhaoDa](https://github.com/jhaoda)

## Лиценция

Данный SDK распространяется под лицензией [MIT](http://opensource.org/licenses/MIT).
