<?php

namespace Profair\StaticBlocks\Setup;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

/**
 * Class UpgradeData
 *
 * @package Profair\StaticBlocks\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var string $_setupVersion Current setup version.
     */
    private $setupVersion;
    /**
     * @var \Magento\Cms\Model\BlockFactory
     */
    private $blockFactory;

    /**
     * InstallData constructor.
     *
     * @param \Magento\Cms\Model\BlockFactory $blockFactory
     */
    public function __construct(BlockFactory $blockFactory)
    {
        $this->blockFactory = $blockFactory;
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->setupVersion = $context->getVersion();
        if (version_compare($this->setupVersion, '1.0.0') < 0) {
            $this->addLogoBlock();
        }
        if (version_compare($this->setupVersion, '1.0.1') < 0) {
            $this->addPhoneBlock();
        }

        $setup->endSetup();
    }

    private function addLogoBlock()
    {
        $cmsBlockData = [
            'title' => 'Logo Header',
            'identifier' => 'logo_header_center',
            'content' => 'Продажа и монтаж<br />кондиционеров',
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->createCmsBlock($cmsBlockData);
    }

    private function addPhoneBlock()
    {
        $phoneContent = '<a href="tel:+375295390000">+375 29 <b>539 00 00</b></a>'
            . '<br><a href="tel:+375296792600">+375 29 <b>679 26 00</b></a><br>';

        $cmsBlockData = [
            'title' => 'Logo Phone',
            'identifier' => 'logo_header_phone',
            'content' => $phoneContent,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->createCmsBlock($cmsBlockData);
    }

    private function createCmsBlock(array $cmsBlockData)
    {
        $this->blockFactory->create()->setData($cmsBlockData)->save();
    }
}