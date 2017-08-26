# SDK для Почты России

[![Total Downloads](https://poser.pugx.org/appwilio/russianpost-sdk/downloads)](https://packagist.org/packages/appwilio/russianpost-sdk)
[![Latest Stable Version](https://poser.pugx.org/appwilio/russianpost-sdk/version)](https://packagist.org/packages/appwilio/russianpost-sdk)
[![License](https://poser.pugx.org/appwilio/russianpost-sdk/license)](https://packagist.org/packages/appwilio/russianpost-sdk)

---

Возможности:

- [трекинг](https://tracking.pochta.ru/specification)
  - [x] единичный трекинг почтовых отправлений
    - [x] информация о наложенном платеже почтового отправления
  - [x] пакетный трекинг почтовых отправлений
- [отправка](https://otpravka.pochta.ru/specification)
  - [ ] расчёт стоимости отправки
  - [ ] нормализация и валидация вводимых данных
  - [ ] работа с единичными заказами и партиями заказов
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

// минимум через 15 минут

$response = $tracker->getTrackingEvents($ticket->getId());

foreach ($response->getItems() as $item) {
    echo $item->getBarcode();
    
    foreach ($item->getOperations as $operation) {
        echo $operation->getOperationId();
        echo $operation->getAttributeId();
        echo $operation->getPerformedAt();
    }
}
```

## Разработчики

- [greabock](https://github.com/greabock)
- [JhaoDa](https://github.com/jhaoda)

## Лиценция

Данный SDK распространяется под лицензией [MIT](http://opensource.org/licenses/MIT).
