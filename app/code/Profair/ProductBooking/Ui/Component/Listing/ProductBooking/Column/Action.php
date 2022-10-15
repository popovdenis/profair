<?php

namespace Profair\ProductBooking\Ui\Component\Listing\ProductBooking\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Action
 *
 * @package Profair\ProductBooking\Ui\Component\Listing\ProductBooking\Column
 */
class Action extends Column
{
    /**
     * @const string
     */
    const URL_PATH_EDIT = 'profair_book_product/book/newAction';
    const URL_PATH_DELETE = 'profair_book_product/book/delete';
    const URL_PATH_ENABLE = 'profair_book_product/book/enable';
    const URL_PATH_DISABLE = 'profair_book_product/book/disable';

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * Action constructor.
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['entity_id'])) {
                    $item[$this->getData('name')] = $this->getActions($item);
                }
            }
        }

        return $dataSource;
    }

    /**
     * Get actions links.
     *
     * @param array $item
     *
     * @return array
     */
    public function getActions(array $item)
    {
        return [
            'edit'   => [
                'href'  => $this->getEditUrl($item['entity_id']),
                'label' => __('Edit')
            ],
            'delete' => [
                'href'    => $this->getDeleteUrl($item['entity_id']),
                'label'   => __('Delete'),
                'confirm' => [
                    'title'   => __('Delete "${ $.$data.product_sku }"'),
                    'message' => __('Are you sure you want to delete: "${ $.$data.product_sku }"?')
                ]
            ]
        ];
    }

    /**
     * Get Edit url.
     *
     * @param int $profileId
     *
     * @return string
     */
    protected function getEditUrl(int $profileId)
    {
        return $this->urlBuilder->getUrl(static::URL_PATH_EDIT, ['id' => $profileId]);
    }

    /**
     * Get Delete url.
     *
     * @param int $profileId
     *
     * @return string
     */
    protected function getDeleteUrl(int $profileId)
    {
        return $this->urlBuilder->getUrl(static::URL_PATH_DELETE, ['id' => $profileId]);
    }

    /**
     * Get Enable url.
     *
     * @param int $profileId
     *
     * @return string
     */
    protected function getEnableUrl(int $profileId)
    {
        return $this->urlBuilder->getUrl(static::URL_PATH_ENABLE, ['id' => $profileId]);
    }

    /**
     * Get Disable url.
     *
     * @param int $profileId
     *
     * @return string
     */
    protected function getDisableUrl(int $profileId)
    {
        return $this->urlBuilder->getUrl(static::URL_PATH_DISABLE, ['id' => $profileId]);
    }
}