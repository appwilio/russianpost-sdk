<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Exceptions;

class MailCategoryException extends \Exception
{
    public static function incorrectCategory(): self
    {
        return new self('Указана некорректная категория РПО');
    }
}
