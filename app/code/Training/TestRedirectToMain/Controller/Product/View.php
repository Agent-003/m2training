<?php

namespace Training\TestRedirectToMain\Controller\Product;

use Psr\Log\LoggerInterface;
use Magento\Catalog\Helper\Product\View as viewHelper;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\Result\RedirectFactory;

class View extends \Magento\Catalog\Controller\Product\View
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Catalog\Helper\Product\View
     */
    protected $viewHelper;

    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    protected $resultRedirectFactory;
  
    public function __construct(
        LoggerInterface $logger,
        viewHelper $viewHelper,
        ForwardFactory $resultForwardFactory,
        Context $context,
        PageFactory $resultPageFactory,
        Session $customerSession,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->logger = $logger;

        $this->resultRedirectFactory=$resultRedirectFactory;
        $this->customerSession=$customerSession;

        parent::__construct($context, $viewHelper, $resultForwardFactory, $resultPageFactory);
    }

    public function execute()
    {
        $this->logger->info('TestRedirectToMain');
       
        if ($this->customerSession->isLoggedIn()) {
            return parent::execute();
        }

        $resultRedirect=$this->resultRedirectFactory->create();
        $resultRedirect->setPath('customer/account/login');     
        return $resultRedirect;     
    }
}
