<?php

namespace Appwilio\RussianPostSDK\Dispatching\Requests;

interface RequestInterface
{
    public function getUrl(): string;

    public function getBodyArray(): array;

    public function getMethod(): string;
}