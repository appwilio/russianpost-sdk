<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Exceptions;

class AddressException extends \Exception
{
    public static function unknownAddressException(): self
    {
        return new self('Неизвестная ошибка в адресе', 450100);
    }

    public static function incorrectAddress(): self
    {
        return new self('Указан некорректный или пустой адрес', 450101);
    }

    public static function addressDoesntExist(): self
    {
        return new self('Адрес с таким id не существует', 450102);
    }


}
