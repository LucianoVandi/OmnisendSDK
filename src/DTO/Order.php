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

    private const PAYMENT_STATUSES = [
        self::PAYMENT_AWAITING,
        self::PAYMENT_PARTIALLY_PAID,
        self::PAYMENT_PARTIALLY_REFUNDED,
        self::PAYMENT_REFUNDED,
        self::PAYMENT_VOIDED,
    ];

    public const ORDER_UNFULFILLED = 'unfulfilled';
    public const ORDER_IN_PROGRESS = 'inProgress';
    public const ORDER_FULFILLED = 'fulfilled';
    public const ORDER_DELIVERED = 'delivered';
    public const ORDER_RESTOCKED = 'restocked';

    private const FULFILLMENT_STATUSES = [
        self::ORDER_UNFULFILLED,
        self::ORDER_IN_PROGRESS,
        self::ORDER_FULFILLED,
        self::ORDER_DELIVERED,
        self::ORDER_RESTOCKED,
    ];

    public const DISCOUNT_PERCENTAGE = 'percentage';
    public const DISCOUNT_FIXED_AMOUNT = 'fixedAmount';
    public const DISCOUNT_FREE_SHIPPING = 'freeShipping';

    private const DISCOUNT_TYPES = [
        self::DISCOUNT_PERCENTAGE,
        self::DISCOUNT_FIXED_AMOUNT,
        self::DISCOUNT_FREE_SHIPPING,
    ];

    private ?string $orderID;

    private ?int $orderNumber;

    private ?string $email;

    private ?string $contactID;

    private ?string $cartID;

    private ?string $shippingMethod;

    private ?string $trackingCode;

    private ?string $courierTitle;

    private ?string $courierUrl;

    private ?string $orderUrl;

    private ?string $source;

    /** @var array<string>|null */
    private ?array $tags;

    private ?string $discountCode;

    private ?string $currency;

    private ?int $subTotalSum;

    /**
     * @var bool|null Whether subTotalSum includes taxes, default: false
     */
    private ?bool $subTotalTaxIncluded;

    private ?int $orderSum;

    private ?int $discountSum;

    /**
     * Discount value:
     * - sum in cents for fixedAmount type;
     * - percentage value for percentage type;
     * - empty for freeShipping
     * @var int|null
     */
    private ?int $discountValue;

    private ?string $discountType; // percentage, fixedAmount, freeShipping

    private ?int $taxSum;

    private ?int $shippingSum;

    private ?string $createdAt;

    private ?string $updatedAt;

    private ?string $contactNote;

    private ?string $paymentMethod;

    private ?string $paymentStatus;

    private ?string $canceledDate;

    private ?string $cancelReason;

    private ?string $fulfillmentStatus;

    private ?Address $billingAddress;

    private ?Address $shippingAddress;

    /** @var array<OrderProduct>|null */
    private ?array $products;

    private ?\stdClass $customFields;

    /**
     * @param array|object $data
     * @return Order
     */
    public static function fromRawData($data): Order
    {
        if (is_array($data)) {
            $data = json_decode(
                (string) json_encode($data)
            );
        } elseif (! is_object($data)) {
            throw new InvalidArgumentException('Argument must be either an array or object.');
        }

        $paymentStatus = in_array($data->paymentStatus, self::PAYMENT_STATUSES)
            ? $data->paymentStatus
            : null;

        $fulfillmentStatus = in_array($data->orderStatus, self::FULFILLMENT_STATUSES)
            ? $data->orderStatus
            : null;

        $discountType = in_array($data->discountType, self::DISCOUNT_TYPES)
            ? $data->discountType
            : null;

        $billingAddress = isset($data->billingAddress)
            ? new Address($data->billingAddress)
            : null;

        $shippingAddress = isset($data->shippingAddress)
            ? new Address($data->shippingAddress)
            : null;

        $order = new self();

        $order->setOrderID($data->orderID)
            ->setOrderNumber($data->orderNumber)
            ->setEmail($data->email)
            ->setContactID($data->contactID)
            ->setCartID($data->cartID)
            ->setShippingMethod($data->shippingMethod)
            ->setTrackingCode($data->trackingCode)
            ->setCourierTitle($data->courierTitle)
            ->setCourierUrl($data->courierUrl)
            ->setOrderUrl($data->orderUrl)
            ->setSource($data->source)
            ->setTags($data->tags)
            ->setDiscountCode($data->discountCode)
            ->setDiscountValue($data->discountValue)
            ->setDiscountType($discountType)
            ->setCurrency($data->currency)
            ->setOrderSum($data->orderSum)
            ->setSubTotalSum($data->subTotalSum)
            ->setSubTotalTaxIncluded($data->subTotalTaxIncluded)
            ->setDiscountSum($data->discountSum)
            ->setTaxSum($data->taxSum)
            ->setShippingSum($data->shippingSum)
            ->setCreatedAt($data->createdAt)
            ->setUpdatedAt($data->updatedAt)
            ->setCanceledDate($data->canceledDate)
            ->setCancelReason($data->cancelReason)
            ->setPaymentMethod($data->paymentMethod)
            ->setPaymentStatus($paymentStatus)
            ->setFulfillmentStatus($fulfillmentStatus)
            ->setContactNote($data->contactNote)
            ->setBillingAddress($billingAddress)
            ->setShippingAddress($shippingAddress)
            ->setCustomFields($data->customFields);

        if (! empty($data->products)) {
            $products = [];

            foreach ($data->products as $product) {
                $products[] = new OrderProduct($product);
            }

            $order->setProducts($products);
        }

        return $order;
    }

    /**
     * @return string|null
     */
    public function getOrderID(): ?string
    {
        return $this->orderID;
    }

    /**
     * @param string|null $orderID
     * @return Order
     */
    public function setOrderID(?string $orderID): Order
    {
        $this->orderID = $orderID;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    /**
     * @param int|null $orderNumber
     * @return Order
     */
    public function setOrderNumber(?int $orderNumber): Order
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Order
     */
    public function setEmail(?string $email): Order
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContactID(): ?string
    {
        return $this->contactID;
    }

    /**
     * @param string|null $contactID
     * @return Order
     */
    public function setContactID(?string $contactID): Order
    {
        $this->contactID = $contactID;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCartID(): ?string
    {
        return $this->cartID;
    }

    /**
     * @param string|null $cartID
     * @return Order
     */
    public function setCartID(?string $cartID): Order
    {
        $this->cartID = $cartID;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShippingMethod(): ?string
    {
        return $this->shippingMethod;
    }

    /**
     * @param string|null $shippingMethod
     * @return Order
     */
    public function setShippingMethod(?string $shippingMethod): Order
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrackingCode(): ?string
    {
        return $this->trackingCode;
    }

    /**
     * @param string|null $trackingCode
     * @return Order
     */
    public function setTrackingCode(?string $trackingCode): Order
    {
        $this->trackingCode = $trackingCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCourierTitle(): ?string
    {
        return $this->courierTitle;
    }

    /**
     * @param string|null $courierTitle
     * @return Order
     */
    public function setCourierTitle(?string $courierTitle): Order
    {
        $this->courierTitle = $courierTitle;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCourierUrl(): ?string
    {
        return $this->courierUrl;
    }

    /**
     * @param string|null $courierUrl
     * @return Order
     */
    public function setCourierUrl(?string $courierUrl): Order
    {
        $this->courierUrl = $courierUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrderUrl(): ?string
    {
        return $this->orderUrl;
    }

    /**
     * @param string|null $orderUrl
     * @return Order
     */
    public function setOrderUrl(?string $orderUrl): Order
    {
        $this->orderUrl = $orderUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     * @return Order
     */
    public function setSource(?string $source): Order
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param array|null $tags
     * @return Order
     */
    public function setTags(?array $tags): Order
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiscountCode(): ?string
    {
        return $this->discountCode;
    }

    /**
     * @param string|null $discountCode
     * @return Order
     */
    public function setDiscountCode(?string $discountCode): Order
    {
        $this->discountCode = $discountCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     * @return Order
     */
    public function setCurrency(?string $currency): Order
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSubTotalSum(): ?int
    {
        return $this->subTotalSum;
    }

    /**
     * @param int|null $subTotalSum
     * @return Order
     */
    public function setSubTotalSum(?int $subTotalSum): Order
    {
        $this->subTotalSum = $subTotalSum;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getSubTotalTaxIncluded(): ?bool
    {
        return $this->subTotalTaxIncluded;
    }

    /**
     * @param bool|null $subTotalTaxIncluded
     * @return Order
     */
    public function setSubTotalTaxIncluded(?bool $subTotalTaxIncluded): Order
    {
        $this->subTotalTaxIncluded = $subTotalTaxIncluded;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrderSum(): ?int
    {
        return $this->orderSum;
    }

    /**
     * @param int|null $orderSum
     * @return Order
     */
    public function setOrderSum(?int $orderSum): Order
    {
        $this->orderSum = $orderSum;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDiscountSum(): ?int
    {
        return $this->discountSum;
    }

    /**
     * @param int|null $discountSum
     * @return Order
     */
    public function setDiscountSum(?int $discountSum): Order
    {
        $this->discountSum = $discountSum;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDiscountValue(): ?int
    {
        return $this->discountValue;
    }

    /**
     * @param int|null $discountValue
     * @return Order
     */
    public function setDiscountValue(?int $discountValue): Order
    {
        $this->discountValue = $discountValue;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiscountType(): ?string
    {
        return $this->discountType;
    }

    /**
     * @param string|null $discountType
     * @return Order
     */
    public function setDiscountType(?string $discountType): Order
    {
        $this->discountType = $discountType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getTaxSum(): ?int
    {
        return $this->taxSum;
    }

    /**
     * @param int|null $taxSum
     * @return Order
     */
    public function setTaxSum(?int $taxSum): Order
    {
        $this->taxSum = $taxSum;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getShippingSum(): ?int
    {
        return $this->shippingSum;
    }

    /**
     * @param int|null $shippingSum
     * @return Order
     */
    public function setShippingSum(?int $shippingSum): Order
    {
        $this->shippingSum = $shippingSum;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     * @return Order
     */
    public function setCreatedAt(?string $createdAt): Order
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     * @return Order
     */
    public function setUpdatedAt(?string $updatedAt): Order
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContactNote(): ?string
    {
        return $this->contactNote;
    }

    /**
     * @param string|null $contactNote
     * @return Order
     */
    public function setContactNote(?string $contactNote): Order
    {
        $this->contactNote = $contactNote;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string|null $paymentMethod
     * @return Order
     */
    public function setPaymentMethod(?string $paymentMethod): Order
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    /**
     * @param string|null $paymentStatus
     * @return Order
     */
    public function setPaymentStatus(?string $paymentStatus): Order
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCanceledDate(): ?string
    {
        return $this->canceledDate;
    }

    /**
     * @param string|null $canceledDate
     * @return Order
     */
    public function setCanceledDate(?string $canceledDate): Order
    {
        $this->canceledDate = $canceledDate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCancelReason(): ?string
    {
        return $this->cancelReason;
    }

    /**
     * @param string|null $cancelReason
     * @return Order
     */
    public function setCancelReason(?string $cancelReason): Order
    {
        $this->cancelReason = $cancelReason;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFulfillmentStatus(): ?string
    {
        return $this->fulfillmentStatus;
    }

    /**
     * @param string|null $fulfillmentStatus
     * @return Order
     */
    public function setFulfillmentStatus(?string $fulfillmentStatus): Order
    {
        $this->fulfillmentStatus = $fulfillmentStatus;

        return $this;
    }

    /**
     * @return Address|null
     */
    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }

    /**
     * @param Address|null $billingAddress
     * @return Order
     */
    public function setBillingAddress(?Address $billingAddress): Order
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * @return Address|null
     */
    public function getShippingAddress(): ?Address
    {
        return $this->shippingAddress;
    }

    /**
     * @param Address|null $shippingAddress
     * @return Order
     */
    public function setShippingAddress(?Address $shippingAddress): Order
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getProducts(): ?array
    {
        return $this->products;
    }

    /**
     * @param array|null $products
     * @return Order
     */
    public function setProducts(?array $products): Order
    {
        $this->products = $products;

        return $this;
    }

    /**
     * @return \stdClass|null
     */
    public function getCustomFields(): ?\stdClass
    {
        return $this->customFields;
    }

    /**
     * @param \stdClass|null $customFields
     * @return Order
     */
    public function setCustomFields(?\stdClass $customFields): Order
    {
        $this->customFields = $customFields;

        return $this;
    }
}
