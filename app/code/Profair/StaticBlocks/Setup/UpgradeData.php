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
     * @var \Magento\Cms\Api\BlockRepositoryInterface
     */
    private $blockRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * InstallData constructor.
     *
     * @param \Magento\Cms\Model\BlockFactory              $blockFactory
     * @param \Magento\Cms\Api\BlockRepositoryInterface    $blockRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        BlockFactory $blockFactory,
        \Magento\Cms\Api\BlockRepositoryInterface $blockRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->blockFactory = $blockFactory;
        $this->blockRepository = $blockRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
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
        if (version_compare($this->setupVersion, '1.0.2') < 0) {
            $this->addBrandsBlock();
            $this->addWorkInstructionBlock();
            $this->addFreeRepairBlock();
            $this->addOurAbilitiesBlock();
        }
        if (version_compare($this->setupVersion, '1.0.3') < 0) {
            $this->addPromotionBlock();
        }
        if (version_compare($this->setupVersion, '1.0.4') < 0) {
            $this->addSendRequestSuccess();
        }

        $setup->endSetup();
    }

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
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

    /**
     * @throws \Magento\Framework\Exception\LocalizedException
     */
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
    
    private function addBrandsBlock()
    {
        $content = '<div class="wrap980">
        <h3>мы предлагаем:</h3>
        <h3>170 моделей 25-ти производителей<br>в каталоге</h3>
        <table class="brands">
        <tbody>
            <tr>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/01.png&quot;}}" alt="" width="150" height="36"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/08.png&quot;}}" width="150" height="74"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/03.jpg&quot;}}" alt="" width="150" height="45"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/02.jpg&quot;}}" width="150" height="20"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/05.jpg&quot;}}" width="150" height="44"></a>
                </td>
            </tr>
            <tr>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/09.png&quot;}}" width="150" height="58"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/07.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/11.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/12.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/04.png&quot;}}" width="150"></a>
                </td>
            </tr>
            <tr>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/13.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/18.jpg&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/14.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/15.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/17.png&quot;}}" width="150"></a>
                </td>
            </tr>
            <tr>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/21.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/20.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/16.jpg&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/17-2.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/19.png&quot;}}" width="150"></a>
                </td>
            </tr>
            <tr>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/22.jpg&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/23.gif&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/24.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/25.png&quot;}}" width="150"></a>
                </td>
                <td style="border-image: initial;">
                    <a href="#"><img src="{{media url=&quot;brand/26.gif&quot;}}" width="150"></a>
                </td>
            </tr>
        </tbody>
        </table>
        </div>';
        $cmsBlockData = [
            'title' => 'Brands',
            'identifier' => 'brands',
            'content' => $content,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->createCmsBlock($cmsBlockData);
    }

    private function addWorkInstructionBlock()
    {
        $content = '<div class="wrap980">
            <h3>Как мы работаем</h3>
            <div class="content"><img src="{{media url=&quot;dogovor.png&quot;}}" alt="">
            <p>Вы оставляете заявку</p>
            <p>Наш менеджер консультирует вас</p>
            <p>Наш специалист проводит замер и подбирает оборудование</p>
            <p>Достовляем и монтируем кондиционер</p>
            <p>Обучаем управлению.</p>
            </div>
            </div>';
        $cmsBlockData = [
            'title' => 'Как мы работаем',
            'identifier' => 'how_we_work',
            'content' => $content,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->createCmsBlock($cmsBlockData);
    }

    private function addFreeRepairBlock()
    {
        $content = '<div class="wrap980">
        <div class="left">бесплатный монтаж кондиционера</div>
        <div class="right"><a href="/">оставить заявку</a></div>
        <p>&nbsp;</p>
        </div>';
        $cmsBlockData = [
            'title' => 'Бесплатный монтаж кондиционера',
            'identifier' => 'free_repair_condition',
            'content' => $content,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->createCmsBlock($cmsBlockData);
    }

    private function addOurAbilitiesBlock()
    {
        $content = '<div class="wrap980">
        <p><img class="lazyload" src="{{media url="serv1.jpg"}}" alt=""><br>Мы официальный дилер</p>
        <p><img class="lazyload" src="{{media url="serv2.jpg"}}" alt=""><br>Бесплатная доставка по РБ</p>
        <p><img class="lazyload" src="{{media url="serv3.jpg"}}" alt=""><br>Качественный монтаж!(Собственные монтажные бригады)</p>
        <p><img class="lazyload" src="{{media url="serv4.jpg"}}" alt=""><br>Гарантия на кондиционеры до 10 лет</p>
        <p><img class="lazyload" src="{{media url="serv5.jpg"}}" alt=""><br>Позитивные цены</p>
        </div>';
        $cmsBlockData = [
            'title' => 'Наши возможности',
            'identifier' => 'our_abilities',
            'content' => $content,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->createCmsBlock($cmsBlockData);
    }

    private function addPromotionBlock()
    {
        $content = '
            <div class="text1">
                <span style="color: red;">Акция!</span>
                <span style="color: #ff5d00;">При покупке кондиционера</span>
            </div>
            <div class="text2">
                <span style="color: #0961ab; font-size: 16px; line-height: 22px;">
                    <a href="https://profair.by/catalog/general/4342/">General Climate GC/GU-А07HR</a>
                </span><br>
                <span style="color: #ff0000; font-size: 20px; line-height: 26px;"><strong>699 руб.</strong>
                <span style="text-decoration: line-through;">785 руб.</span> </span>
            </div>
            <div class="text3">
                <span style="color: #ff0000;">+ монтаж кондиционера <br>за 99 руб.</span>
                <span style="text-decoration: line-through;">230 руб.</span>
            </div>';
        $cmsBlockData = [
            'title' => 'Акция',
            'identifier' => 'sale_promotion',
            'content' => $content,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->createCmsBlock($cmsBlockData);
    }

    private function addSendRequestSuccess()
    {
        $content = '
            <h4>Оставьте заявку</h4>
            <div class="descerr">Ваш запрос принят, наш менеджер свяжется с вами в ближайшее время</div>';
        $cmsBlockData = [
            'title' => 'Оставьте заявку',
            'identifier' => 'send_request_success',
            'content' => $content,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->createCmsBlock($cmsBlockData);
    }

    /**
     * @param $identifier
     *
     * @return \Magento\Cms\Api\Data\BlockInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function getCmsBlock($identifier)
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('identifier', $identifier, 'eq')->create();

        $items = $this->blockRepository->getList($searchCriteria)->getItems();

        return $items ? array_shift($items) : null;
    }

    /**
     * @param array $cmsBlockData
     *
     * @return \Magento\Cms\Model\Block
     */
    private function getCmsBlockEntity(array $cmsBlockData)
    {
        return $this->blockFactory->create()->setData($cmsBlockData);
    }

    /**
     * @param array $cmsBlockData
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function createCmsBlock(array $cmsBlockData)
    {
        if (!$cmsBlock = $this->getCmsBlock($cmsBlockData['identifier'])) {
            $cmsBlock = $this->getCmsBlockEntity($cmsBlockData);
        }

        $this->blockRepository->save($cmsBlock);
    }
}