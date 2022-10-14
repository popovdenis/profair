<?php

namespace Profair\ProductBooking\Model;

use Exception;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Profair\ProductBooking\Api\Data\ProductBookingInterface;
use Profair\ProductBooking\Api\Data\ProductBookingInterfaceFactory;
use Profair\ProductBooking\Model\ResourceModel\ProductBooking as ProductBookingResource;
use Profair\ProductBooking\Model\ResourceModel\ProductBooking\CollectionFactory;
use Profair\ProductBooking\Api\ProductBookingRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterfaceFactory;

/**
 * Class ProductBookingRepository
 *
 * @package Profair\ProductBooking\Model
 */
class ProductBookingRepository implements ProductBookingRepositoryInterface
{
    /**
     * @var \Profair\ProductBooking\Api\Data\ProductBookingInterface
     */
    private $productBooking;
    /**
     * @var \Profair\ProductBooking\Model\ResourceModel\ProductBooking
     */
    private $resource;
    /**
     * @var \Profair\ProductBooking\Model\ResourceModel\ProductBooking\CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var \Magento\Framework\Api\SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * ProductBookingRepository constructor.
     *
     * @param \Profair\ProductBooking\Api\Data\ProductBookingInterface                     $productBooking
     * @param \Profair\ProductBooking\Model\ResourceModel\ProductBooking                   $resource
     * @param \Profair\ProductBooking\Model\ResourceModel\ProductBooking\CollectionFactory $collectionFactory
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface           $collectionProcessor
     * @param \Magento\Framework\Api\SearchResultsInterfaceFactory                         $searchResultsFactory
     * @param \Magento\Framework\Api\SearchCriteriaBuilder                                 $searchCriteriaBuilder
     */
    public function __construct(
        ProductBookingInterfaceFactory $productBooking,
        ProductBookingResource $resource,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultsFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->productBooking = $productBooking;
        $this->resource = $resource;
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $bookingId)
    {
        /* @var ProductBookingInterface $productBooking */
        $productBooking = $this->productBooking->create();
        $this->resource->load($productBooking, $bookingId, ProductBookingInterface::ENTITY_ID);

        if (!$productBooking->getId()) {
            throw new NoSuchEntityException(__('Such entity does not exist.'));
        }

        return $productBooking;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntityFactory()
    {
        return $this->productBooking->create();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection */
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var \Magento\Framework\Api\SearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->getSize());

        $searchResults->setItems(array_map(
            function (ProductBookingInterface $item) {
                return $this->getById($item->getId());
            },
            $collection->getItems()
        ));

        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function save(ProductBookingInterface $booking)
    {
        try {
            $this->resource->save($booking);
        } catch (Exception $e) {
            throw new CouldNotSaveException(
                __('Could not save booking product: %1', $e->getMessage()),
                $e
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ProductBookingInterface $booking)
    {
        try {
            $this->resource->delete($booking);
        } catch (Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the booking product: %1', $exception->getMessage())
            );
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($bookingId)
    {
        return $this->delete($this->getById($bookingId));
    }

    /**
     * {@inheritdoc}
     */
    public function getActiveBookingProducts()
    {
        $this->searchCriteriaBuilder->addFilter(
            ProductBookingInterface::STATUS,
            [
                ProductBookingInterface::BOOKING_PRODUCT_STATUS_OPEN,
                ProductBookingInterface::BOOKING_PRODUCT_STATUS_IN_PROGRESS,
            ],
            'in'
        );
        $importProfiles = $this->getList($this->searchCriteriaBuilder->create());

        if ($importProfiles->getTotalCount()) {
            return $importProfiles->getItems();
        }

        return [];
    }
}