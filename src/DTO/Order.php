<?php

namespace Lvandi\OmnisendSDK\DTO;

use InvalidArgumentException;

class Order implements \JsonSerializable
{
    use JsonSerializeTrait;

    public const PAYMENT_AWAITING = 'awaitingPayment';
    public const PAYMENT_PARTIALLY_PAID = 'partiallyPaid';
    public const PAYMENT_PARTIALLY_REFUNDED = 'partiallyRefunded';
    public const PAYMENT_REFUNDED = 'refunded';
    public const PAYMENT_VOIDED = 'voided';

    public const ORDER_UNFULFILLED = 'unfulfilled';
    public const ORDER_IN_PROGRESS = 'inProgress';
    public const ORDER_FULFILLED = 'fulfilled';
    public const ORDER_DELIVERED = 'delivered';
    public const ORDER_RESTOCKED = 'restocked';

    public ?string $orderID;

    public ?string $orderNumber;

    public ?string $email;

    public ?string $contactID;

    public ?string $firstName;

    public ?string $lastName;

    public ?string $company;

    public ?string $phone;

    public ?string $cartID;

    public ?string $shippingMethod;

    public ?string $trackingCode;

    public ?string $courierTitle;

    public ?string $courierUrl;

    public ?string $orderUrl;

    public ?string $source;

    /** @var array<string>|null  */
    public ?array $tags;

    public ?string $discountCode;

    public ?string $currency;

    public ?int $subTotalSum;

    public ?bool $subTotalTaxIncluded;

    public ?int $orderSum;

    public ?int $discountSum;

    public ?int $discountValue;

    public ?string $discountType; // percentage, fixedAmount, freeShipping

    public ?int $taxSum;

    public ?int $shippingSum;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?string $contactNote;

    public ?string $paymentMethod;

    public ?string $paymentStatus;

    public ?string $canceledDate;

    public ?string $cancelReason;

    public ?string $fulfillmentStatus;

    public ?Address $billingAddress;

    public ?Address $shippingAddress;

    /** @var array<OrderProduct>|null  */
    public ?array $products;

    public ?\stdClass $customFields;

    public static function fromRawData($data): Order
    {
        if (is_array($data)) {
            $data = json_decode(
                (string) json_encode($data)
            );
        } elseif (! is_object($data)) {
            throw new InvalidArgumentException('Argument must be either an array or object.');
        }

//        $status = in_array($data->status, self::STATUSES)
//            ? $data->status
//            : null;

        $order = new self();

        return $order;
    }
}
