<?php

declare(strict_types = 1);

namespace Appwilio\RussianPostSDK\Dispatching\Endpoints\Orders\Entites;

use Appwilio\RussianPostSDK\Dispatching\DataAware;
use Appwilio\RussianPostSDK\Dispatching\Contracts\Arrayable;
use Appwilio\RussianPostSDK\Dispatching\Entities\DeliveryTime;

final class Order implements Arrayable
{
    use DataAware;

    /** @var bool */
    private $addressChanged;

    /** @var string */
    private $addressTypeTo;

    /** @var string */
    private $areaTo;

    /** @var int */
    private $aviaRate;

    /** @var int */
    private $aviaRateWithVat;

    /** @var int */
    private $aviaRateWoVat;

    /** @var string */
    private $barcode;

    /** @var string */
    private $brandName;

    /** @var string */
    private $buildingTo;

    /** @var string */
    private $comment;

    /** @var bool */
    private $completenessChecking;

    /** @var int */
    private $completenessCheckingRateWithVat;

    /** @var int */
    private $completenessCheckingRateWoVat;

    /** @var string */
    private $corpusTo;

    /** @var CustomsDeclaration */
    private $customsDeclaration;

    /** @var DeliveryTime */
    private $deliveryTime;

    /** @var bool */
    private $deliveryWithCod;

    /** @var array */
    private $dimension;

    /** @var string */
    private $envelopeType;

    /** @var int */
    private $fragileRateWithVat;

    /** @var int */
    private $fragileRateWoVat;

    /** @var string */
    private $givenName;

    /** @var OrderItem */
    private $goods;

    /** @var int */
    private $groundRate;

    /** @var int */
    private $groundRateWithVat;

    /** @var int */
    private $groundRateWoVat;

    /** @var string */
    private $hotelTo;

    /** @var string */
    private $houseTo;

    /** @var int */
    private $id;

    /** @var int */
    private $indexTo;

    /** @var int */
    private $insrRate;

    /** @var int */
    private $insrRateWithVat;

    /** @var int */
    private $insrRateWoVat;

    /** @var int */
    private $insrValue;

    /** @var int */
    private $inventoryRateWithVat;

    /** @var int */
    private $inventoryRateWoVat;

    /** @var bool */
    private $isDeleted;

    /** @var string */
    private $letterTo;

    /** @var string */
    private $locationTo;

    /** @var string */
    private $mailCategory;

    /** @var int */
    private $mailDirect;

    /** @var string */
    private $mailRank;

    /** @var string */
    private $mailType;

    /** @var bool */
    private $manualAddressInput;

    /** @var int */
    private $mass;

    /** @var int */
    private $massRate;

    /** @var int */
    private $massRateWithVat;

    /** @var int */
    private $massRateWoVat;

    /** @var string */
    private $middleName;

    /** @var string */
    private $noticePaymentMethod;

    /** @var int */
    private $noticeRateWithVat;

    /** @var int */
    private $noticeRateWoVat;

    /** @var string */
    private $numAddressTypeTo;

    /** @var string */
    private $officeTo;

    /** @var string */
    private $orderNum;

    /** @var int */
    private $oversizeRateWithVat;

    /** @var int */
    private $oversizeRateWoVat;

    /** @var int */
    private $payment;

    /** @var string */
    private $paymentMethod;

    /** @var string */
    private $placeTo;

    /** @var string */
    private $postmarks;

    /** @var string */
    private $postofficeCode;

    /** @var string */
    private $rawAddress;

    /** @var string */
    private $recipientName;

    /** @var string */
    private $regionTo;

    /** @var string */
    private $roomTo;

    /** @var string */
    private $slashTo;

    /** @var int */
    private $smsNoticeRecipient;

    /** @var int */
    private $smsNoticeRecipientRateWithVat;

    /** @var int */
    private $smsNoticeRecipientRateWoVat;

    /** @var string */
    private $strIndexTo;

    /** @var string */
    private $streetTo;

    /** @var string */
    private $surname;

    /** @var int */
    private $telAddress;

    /** @var int */
    private $totalRateWoVat;

    /** @var int */
    private $totalVat;

    /** @var string */
    private $transportMode;

    /** @var string */
    private $transportType;

    /** @var int */
    private $version;

    /** @var string */
    private $vladenieTo;
}
