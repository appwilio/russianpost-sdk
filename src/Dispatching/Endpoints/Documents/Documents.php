<?php

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Documents;

use GuzzleHttp\Psr7\UploadedFile;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class Documents
{
    public const PRINT_TYPE_PAPER  = 'PAPER';
    public const PRINT_TYPE_THERMO = 'THERMO';

    public const PRINT_FORM_ONE_SIDE = 'ONE_SIDED';
    public const PRINT_FORM_TWO_SIDE = 'TWO_SIDED';

    /** @var ApiClient */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Форма Ф7п для заказа.
     *
     * @param  string                   $orderId
     * @param  \DateTimeInterface|null  $sendingDate
     * @param  string|null              $printType
     *
     * @return UploadedFile
     */
    public function orderF7Form(string $orderId, ?\DateTimeInterface $sendingDate = null, ?string $printType = null): UploadedFile
    {
        $request = $this->buildRequest([
            'print-type'   => $printType,
            'sending-date' => $this->formatSendingDate($sendingDate),
        ]);

        return $this->client->get("/1.0/forms/{$orderId}/f7pdf", $request);
    }

    /**
     * Форма Ф112ЭК для заказа.
     *
     * @param  string                   $orderId
     * @param  \DateTimeInterface|null  $sendingDate
     *
     * @return UploadedFile
     */
    public function orderF112Form(string $orderId, ?\DateTimeInterface $sendingDate = null): UploadedFile
    {
        $request = $this->buildRequest([
            'sending-date' => $this->formatSendingDate($sendingDate),
        ]);

        return $this->client->get("/1.0/forms/{$orderId}/f112pdf", $request);
    }

    public function orderFormsBundleBacklog(string $orderId, ?\DateTimeInterface $sendingDate = null): UploadedFile
    {
        $request = $this->buildRequest([
            'sending-date' => $this->formatSendingDate($sendingDate),
        ]);

        return $this->client->get("/1.0/forms/backlog/{$orderId}/forms", $request);
    }

    public function orderFormBundle(string $orderId, ?\DateTimeInterface $sendingDate = null, ?string $printType = null): UploadedFile
    {
        $request = $this->buildRequest([
            'print-type'   => $printType,
            'sending-date' => $this->formatSendingDate($sendingDate),
        ]);

        return $this->client->get("/1.0/forms/{$orderId}/forms", $request);
    }

    /**
     * Пакет документов для партии.
     *
     * @param  string       $batchName
     * @param  string|null  $printType
     * @param  string|null  $printTypeForm
     *
     * @return UploadedFile
     */
    public function batchFormBundle(string $batchName, ?string $printType = null, ?string $printTypeForm = null): UploadedFile
    {
        $request = $this->buildRequest([
            'print-type'      => $printType,
            'print-type-form' => $printTypeForm,
        ]);

        return $this->client->get("/1.0/forms/{$batchName}/zip-all", $request);
    }

    /**
     * Форма Ф103 для партии.
     *
     * @param  string  $batchName
     *
     * @return UploadedFile
     */
    public function batchF103Form(string $batchName): UploadedFile
    {
        return $this->client->get("/1.0/forms/{$batchName}/f103pdf");
    }

    /**
     * Форма акта осмотра содержимого партии.
     *
     * @param  string  $batchName
     *
     * @return UploadedFile
     */
    public function batchCheckingForm(string $batchName): UploadedFile
    {
        return $this->client->get("/1.0/forms/{$batchName}/completeness-checking-form");
    }

    /**
     * Подготовка и отправка электронной формы Ф103 для партии.
     *
     * @param  string  $batchName
     *
     * @return bool
     */
    public function batchCheckIn(string $batchName): bool
    {
        return (bool) $this->client->get("/1.0/batch/{$batchName}/checkin");
    }

    private function formatSendingDate(?\DateTimeInterface $sendingDate): ?string
    {
        return $sendingDate ? $sendingDate->format('Y-m-d') : null;
    }

    private function buildRequest(array $query): Arrayable
    {
        return new class($query) implements Arrayable {
            private $query;

            public function __construct(array $query)
            {
                $this->query = $query;
            }

            public function toArray(): array
            {
                return $this->query;
            }
        };
    }
}
