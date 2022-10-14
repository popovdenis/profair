<?php

namespace Profair\ProductBooking\Model\DataProvider;

use Profair\ProductBooking\Api\Data\ProductBookingInterface;
use Profair\ProductBooking\Api\ProductBookingRepositoryInterface;
use Profair\ProductBooking\Model\ResourceModel\ProductBooking\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

/**
 * Class ProductBooking
 *
 * @package Profair\ProductBooking\Model\DataProvider
 */
class ProductBooking extends AbstractDataProvider
{
    /**
     * @var \Profair\ProductBooking\Model\ResourceModel\ProductBooking\Collection
     */
    protected $collection;
    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersist;
    /**
     * @var array
     */
    protected $loadedData;
    /**
     * @var \Profair\ProductBooking\Api\ProductBookingRepositoryInterface
     */
    private $bookingRepository;
    /**
     * @var \Magento\Ui\DataProvider\Modifier\PoolInterface
     */
    private $pool;

    /**
     * ProductBooking constructor.
     *
     * @param                                                                              $name
     * @param                                                                              $primaryFieldName
     * @param                                                                              $requestFieldName
     * @param \Profair\ProductBooking\Model\ResourceModel\ProductBooking\CollectionFactory $collectionFactory
     * @param \Magento\Framework\App\Request\DataPersistorInterface                        $dataPersist
     * @param \Profair\ProductBooking\Api\ProductBookingRepositoryInterface                $bookingRepository
     * @param \Magento\Ui\DataProvider\Modifier\PoolInterface                              $pool
     * @param array                                                                        $meta
     * @param array                                                                        $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersist,
        ProductBookingRepositoryInterface $bookingRepository,
        PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersist = $dataPersist;

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->bookingRepository = $bookingRepository;
        $this->pool = $pool;
    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     *
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        foreach ($this->getCollection()->getItems() as $item) {
            $item = $this->bookingRepository->getById($item->getId());
            $this->loadedData[$item->getId()] = $item->getData();
        }

        $data = $this->dataPersist->get('booking_product');

        if (!empty($data)) {
            $booking = $this->collection->getNewEmptyItem();
            $booking->setData($data);
            $this->loadedData[$booking->getId()] = $booking->getData();
            $this->dataPersist->clear('booking_product');
        }

        return $this->loadedData;
    }

    /**
     * @inheritdoc
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        $this->getCollection()->addFieldToFilter(
            ($filter->getField() === ProductBookingInterface::ENTITY_ID
                ? 'main_table.' . $filter->getField()
                : $filter->getField()),
            [$filter->getConditionType() => $filter->getValue()]
        );
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getMeta()
    {
        $meta = parent::getMeta();
        /** @var \Magento\Ui\DataProvider\Modifier\ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }

        return $meta;
    }
}