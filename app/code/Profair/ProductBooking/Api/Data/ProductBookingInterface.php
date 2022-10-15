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
    const PHONE_NUMBER = 'phone_number';
    /**
     * @var string
     */
    const STATUS = 'status';
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
     * Return phone number
     *
     * @return string|null
     */
    public function getPhoneNumber(): ?string;

    /**
     * Set phone number
     *
     * @param $phoneNumber
     *
     * @return ProductBookingInterface
     */
    public function setPhoneNumber($phoneNumber): self;

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