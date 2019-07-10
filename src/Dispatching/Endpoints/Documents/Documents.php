<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Documents;

use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiRequest;
use GuzzleHttp\Psr7\UploadedFile;

final class Documents
{
    public const PRINT_TYPE_PAPER = 'PAPER';
    public const PRINT_TYPE_THERMO = 'THERMO';

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
     * Форма Ф112 для заказа.
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
     * @param  string  $batchName
     *
     * @return UploadedFile
     */
    public function batchFormBundle(string $batchName): UploadedFile
    {
        return $this->client->get("/1.0/forms/{$batchName}/zip-all");
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

    private function formatSendingDate(?\DateTimeInterface $sendingDate): ?string
    {
        return $sendingDate ? $sendingDate->format('Y-m-d') : null;
    }

    private function buildRequest(array $query): ApiRequest
    {
        return new class($query) extends ApiRequest {
            private $query;

            public function __construct(array $query)
            {
                $this->query = \array_filter($query);
            }

            public function toArray(): array
            {
                return $this->query;
            }
        };
    }
}
