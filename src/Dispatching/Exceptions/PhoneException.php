<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Exceptions;

class PhoneException extends \Exception
{
    public static function unknownPhoneException(): self
    {
        return new self('Неизвестная ошибка в номере телефона', 451100);
    }

    public static function incorrectPhone(): self
    {
        return new self('Указан некорректный или пустой номер телефона', 451101);
    }

    public static function phoneDoesntExist(): self
    {
        return new self('Номер телефона с таким id не существует', 451102);
    }

}
