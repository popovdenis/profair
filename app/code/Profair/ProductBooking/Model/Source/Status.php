<?php

namespace Profair\ProductBooking\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 *
 * @package Profair\ProductBooking\Model\Source
 */
class Status extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    /**
     * Item Status values
     */
    const STATUS_ACTIVE = 1;

    const STATUS_IN_PROGRESS = 0;

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [
            self::STATUS_ACTIVE => __('Active'),
            self::STATUS_IN_PROGRESS => __('In Progress')
        ];
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }
}