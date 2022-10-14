<?php

namespace Profair\ProductBooking\Controller\Adminhtml;

/**
 * Class Book
 *
 * @package Profair\ProductBooking\Controller\Adminhtml
 */
abstract class Book extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;
    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var \Profair\ProductBooking\Api\ProductBookingRepositoryInterface
     */
    protected $bookingRepository;
    /**
     * @var \Profair\ProductBooking\Api\Data\ProductBookingInterfaceFactory
     */
    protected $bookingFactory;
    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * Initialize Group Controller
     *
     * @param \Magento\Backend\App\Action\Context                             $context
     * @param \Magento\Framework\Registry                                     $coreRegistry
     * @param \Magento\Backend\Model\View\Result\ForwardFactory               $resultForwardFactory
     * @param \Magento\Framework\View\Result\PageFactory                      $resultPageFactory
     * @param \Profair\ProductBooking\Api\ProductBookingRepositoryInterface   $bookingRepository
     * @param \Profair\ProductBooking\Api\Data\ProductBookingInterfaceFactory $bookingFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Profair\ProductBooking\Api\ProductBookingRepositoryInterface $bookingRepository,
        \Profair\ProductBooking\Api\Data\ProductBookingInterfaceFactory $bookingFactory,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->bookingRepository = $bookingRepository;
        $this->bookingFactory = $bookingFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * Initiate action
     *
     * @return \Profair\ProductBooking\Controller\Adminhtml\Book
     */
    protected function _initAction()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Profair_ProductBooki::book')->_addBreadcrumb(__('Booking Products'), __('Products'));

        return $this;
    }

    /**
     * Determine if authorized to perform group actions.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Profair_ProductBook::book');
    }
}