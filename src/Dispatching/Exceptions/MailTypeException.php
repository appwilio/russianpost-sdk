<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Exceptions;

class MailTypeException extends \Exception
{
    public static function incorrectType(): self
    {
        return new self('Указан некорректный вид РПО');
    }
}
