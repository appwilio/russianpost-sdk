<?php

/**
 * This file is part of RussianPost SDK package.
 *
 * © Appwilio (http://appwilio.com), JhaoDa (https://github.com/jhaoda)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Documents;

use GuzzleHttp\Psr7\UploadedFile;
use Appwilio\RussianPostSDK\Core\GenericRequest;
use Appwilio\RussianPostSDK\Dispatching\Enum\PrintType;
use Appwilio\RussianPostSDK\Dispatching\Http\ApiClient;
use Appwilio\RussianPostSDK\Dispatching\Enum\PrintFormType;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;

final class Documents
{
    /** @var ApiClient */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Форма Ф7п для заказа.
     *
     * @see https://otpravka.pochta.ru/specification#/documents-create_f7_f22
     *
     * @param  string                   $orderId
     * @param  \DateTimeInterface|null  $sendingDate
     * @param  PrintType|null           $printType
     *
     * @return UploadedFile
     */
    public function orderF7Form(string $orderId, ?\DateTimeInterface $sendingDate = null, ?PrintType $printType = null): UploadedFile
    {
        $request = GenericRequest::create([
            'print-type'   => $printType,
            'sending-date' => $this->formatSendingDate($sendingDate),
        ]);

        return $this->client->get("/1.0/forms/{$orderId}/f7pdf", $request);
    }

    /**
     * Форма Ф112ЭК для заказа.
     *
     * @see https://otpravka.pochta.ru/specification#/documents-create_f112
     *
     * @param  string                   $orderId
     * @param  \DateTimeInterface|null  $sendingDate
     *
     * @return UploadedFile
     */
    public function orderF112Form(string $orderId, ?\DateTimeInterface $sendingDate = null): UploadedFile
    {
        $request = GenericRequest::create([
            'id'           => $orderId,
            'sending-date' => $this->formatSendingDate($sendingDate),
        ]);

        return $this->client->get("/1.0/forms/{$orderId}/f112pdf", $request);
    }

    /**
     * Формы для заказа (до формирования партии).
     *
     * https://otpravka.pochta.ru/specification#/documents-create_forms_backlog
     *
     * @param  string                   $orderId
     * @param  \DateTimeInterface|null  $sendingDate
     *
     * @return UploadedFile
     */
    public function orderFormsBundleBacklog(string $orderId, ?\DateTimeInterface $sendingDate = null): UploadedFile
    {
        $request = GenericRequest::create([
            'sending-date' => $this->formatSendingDate($sendingDate),
        ]);

        return $this->client->get("/1.0/forms/backlog/{$orderId}/forms", $request);
    }

    /**
     * Формы для заказа (после формирования партии).
     *
     * @sse https://otpravka.pochta.ru/specification#/documents-create_forms
     *
     * @param  string                   $orderId
     * @param  \DateTimeInterface|null  $sendingDate
     * @param  PrintType|null           $printType
     *
     * @return UploadedFile
     */
    public function orderFormBundle(string $orderId, ?\DateTimeInterface $sendingDate = null, ?PrintType $printType = null): UploadedFile
    {
        $request = GenericRequest::create([
            'print-type'   => $printType,
            'sending-date' => $this->formatSendingDate($sendingDate),
        ]);

        return $this->client->get("/1.0/forms/{$orderId}/forms", $request);
    }

    /**
     * Пакет документов для партии.
     *
     * @see https://otpravka.pochta.ru/specification#/documents-create_all_docs
     *
     * @param  string              $batchName
     * @param  PrintType|null      $printType
     * @param  PrintFormType|null  $printTypeForm
     *
     * @return UploadedFile
     */
    public function batchFormBundle(string $batchName, ?PrintType $printType = null, ?PrintFormType $printTypeForm = null): UploadedFile
    {
        $request = GenericRequest::create([
            'print-type'      => $printType,
            'print-type-form' => $printTypeForm,
        ]);

        return $this->client->get("/1.0/forms/{$batchName}/zip-all", $request);
    }

    /**
     * Форма Ф103 для партии.
     *
     * @see https://otpravka.pochta.ru/specification#/documents-create_f103
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
     * Данный акт будет создан только в том случае, если подключена услуга проверки комплектности.
     *
     * @see https://otpravka.pochta.ru/specification#/documents-create_comp_check_form
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
     * @see https://otpravka.pochta.ru/specification#/documents-checkin
     *
     * @param  string  $batchName
     *
     * @return bool
     */
    public function batchCheckIn(string $batchName): bool
    {
        return (bool) $this->client->get("/1.0/batch/{$batchName}/checkin");
    }

    /**
     * Возвратный ярлык на одной странице.
     *
     * @see https://otpravka.pochta.ru/specification#/documents-easy_return_pdf
     *
     * @param  string          $barcode
     * @param  PrintType|null  $printType
     *
     * @return UploadedFile
     */
    public function easyReturnForm(string $barcode, ?PrintType $printType = null): UploadedFile
    {
        $request = GenericRequest::create([
            'print-type' => $printType,
        ]);

        return $this->client->get("/1.0/forms/{$barcode}/easy-return-pdf", $request);
    }

    private function formatSendingDate(?\DateTimeInterface $sendingDate): ?string
    {
        return $sendingDate ? $sendingDate->format('Y-m-d') : null;
    }
}
