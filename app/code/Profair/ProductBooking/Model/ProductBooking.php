<?php

namespace Profair\ProductBooking\Model;

use Magento\Framework\Model\AbstractModel;
use Profair\ProductBooking\Api\Data\ProductBookingInterface;

/**
 * Class ProductBooking
 *
 * @package Profair\ProductBooking\Model
 */
class ProductBooking extends AbstractModel implements ProductBookingInterface
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'atom_approval_workflow';

    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(\Profair\ProductBooking\Model\ResourceModel\ProductBooking::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): ?int
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id): ProductBookingInterface
    {
        return $this->setData(self::ENTITY_ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductId(): ?int
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setProductId($productId): ProductBookingInterface
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber(): ?string
    {
        return $this->getData(self::PHONE_NUMBER);
    }

    /**
     * {@inheritdoc}
     */
    public function setPhoneNumber($phoneNumber): ProductBookingInterface
    {
        return $this->setData(self::PHONE_NUMBER, $phoneNumber);
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus(): ?string
    {
        return $this->getData(self::STATUS);
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus($status): ProductBookingInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setCreatedAt(string $createdAt): ProductBookingInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedAt(): string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * {@inheritdoc}
     */
    public function setUpdatedAt(string $updatedAt): ProductBookingInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}