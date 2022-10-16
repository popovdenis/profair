<?php

namespace Profair\ProductBooking\Api\Data;

/**
 * Interface ProductBookingInterface
 *
 * @package Profair\ProductBooking\Api\Data
 */
interface ProductBookingInterface
{
    const BOOKING_PRODUCT_STATUS_OPEN = 'open';
    const BOOKING_PRODUCT_STATUS_IN_PROGRESS = 'in_progress';
    const BOOKING_PRODUCT_STATUS_CLOSED = 'closed';

    const REQUEST_TYPE_BOOKING = 'booking';
    const REQUEST_TYPE_QUESTION = 'question';

    /**
     * @var int
     */
    const ENTITY_ID = 'entity_id';
    /**
     * @var int
     */
    const PRODUCT_SKU = 'product_sku';
    /**
     * @var string
     */
    const CONTACT_NAME = 'contact_name';
    /**
     * @var string
     */
    const CONTACT_PHONE = 'contact_phone';
    /**
     * @var string
     */
    const CONTACT_EMAIL = 'contact_email';
    /**
     * @var string
     */
    const STATUS = 'status';
    /**
     * @var string
     */
    const REQUEST_TYPE = 'request_type';
    /**
     * @var string
     */
    const CREATED_AT = 'created_at';
    /**
     * @var string
     */
    const UPDATED_AT = 'updated_at';

    /**
     * Return Entity Id
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * Set Entity Id
     *
     * @param $id
     *
     * @return ProductBookingInterface
     */
    public function setId($id): self;

    /**
     * Return Product SKU
     *
     * @return string|null
     */
    public function getProductSku(): ?string;

    /**
     * Set Product SKU
     *
     * @param $sku
     *
     * @return ProductBookingInterface
     */
    public function setProductSku($sku): self;

    /**
     * Return contact name
     *
     * @return string|null
     */
    public function getContactName(): ?string;

    /**
     * Set contact name
     *
     * @param $contactName
     *
     * @return ProductBookingInterface
     */
    public function setContactName($contactName): self;

    /**
     * Return phone number
     *
     * @return string|null
     */
    public function getContactPhone(): ?string;

    /**
     * Set contact phone
     *
     * @param $contactPhone
     *
     * @return ProductBookingInterface
     */
    public function setContactPhone($contactPhone): self;

    /**
     * Return contact email
     *
     * @return string|null
     */
    public function getContactEmail(): ?string;

    /**
     * Set contact email.
     *
     * @param $contactEmail
     *
     * @return ProductBookingInterface
     */
    public function setContactEmail($contactEmail): self;

    /**
     * Return booking status
     *
     * @return string|null
     */
    public function getStatus(): ?string;

    /**
     * Set booking status
     *
     * @param $status
     *
     * @return ProductBookingInterface
     */
    public function setStatus($status): self;

    /**
     * Return request type
     *
     * @return string|null
     */
    public function getRequestType(): ?string;

    /**
     * Set request type
     *
     * @param $requestType
     *
     * @return ProductBookingInterface
     */
    public function setRequestType($requestType): self;

    /**
     * Return Created At
     *
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * Set Created At
     *
     * @param string $createdAt
     *
     * @return ProductBookingInterface
     */
    public function setCreatedAt(string $createdAt): self;

    /**
     * Return Updated At
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set Updated At
     *
     * @param string $updatedAt
     *
     * @return ProductBookingInterface
     */
    public function setUpdatedAt(string $updatedAt): self;
}