<?php

namespace Training\Test\Plugin\Controller\Product;

class View
{
    protected $customerSession;
    protected $redirectFactory;

    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
    ) {
        $this->redirectFactory=$redirectFactory;
        $this->customerSession=$customerSession;
    }

    public function aroundExecute(
        \Magento\Catalog\Controller\Product\View $subject,
        // callable $proceed
        \Closure $proceed
    ) {

        if ($this->customerSession->isLoggedIn()) {
            return $proceed();
        }
        return $this->redirectFactory->create()->setPath('customer/account/login');

    }
}
