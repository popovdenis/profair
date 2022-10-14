<?php

namespace Profair\ProductBooking\Api;

use Profair\ProductBooking\Api\Data\ProductBookingInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface ProductBookingRepositoryInterface
 *
 * @package Profair\ProductBooking\Api
 */
interface ProductBookingRepositoryInterface
{
    /**
     * Get info about booking product entity by entity ID
     *
     * @param int $bookingId
     *
     * @return \Profair\ProductBooking\Api\Data\ProductBookingInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $bookingId);

    /**
     * Get new entity.
     *
     * @return \Profair\ProductBooking\Api\Data\ProductBookingInterface
     */
    public function getEntityFactory();

    /**
     * Retrieve get import profiles that match te specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Save booking product.
     *
     * @param \Profair\ProductBooking\Api\Data\ProductBookingInterface $booking
     *
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(ProductBookingInterface $booking);

    /**
     * Delete booking product.
     *
     * @param \Profair\ProductBooking\Api\Data\ProductBookingInterface $booking
     *
     * @return boolean
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(ProductBookingInterface $booking);

    /**
     * Delete booking product by ID.
     *
     * @param int $bookingId
     *
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($bookingId);

    /**
     * Get active booking product entities.
     *
     * @return \Profair\ProductBooking\Api\Data\ProductBookingInterface[]
     */
    public function getActiveBookingProducts();
}