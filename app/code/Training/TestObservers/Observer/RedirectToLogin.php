<?php

namespace Training\TestObservers\Observer;

use Magento\Framework\Event\ObserverInterface;

class RedirectToLogin implements ObserverInterface
{

    /**
     * @var \Magento\Customer\Model\Session
     */
    private $customerSession;

    /**
     * @var \Magento\Framework\App\Response\RedirectInterface
     */
    private $redirect;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @param \Magento\Framework\App\Response\RedirectInterface $redirect
     * @param \Magento\Framework\App\ActionFlag $actionFlag
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Customer\Model\Session $customerSession,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->redirect = $redirect;
        $this->customerSession = $customerSession;
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $request = $observer->getEvent()->getData('request');

        $this->logger->debug($request->getModuleName());
        $this->logger->debug($request->getControllerName());
        $this->logger->debug($request->getActionName());

        if (!$this->customerSession->isLoggedIn()) {
            if (
                $request->getModuleName() == 'catalog'
                && $request->getControllerName() == 'product'
                && $request->getActionName() == 'view'
            ) {
                $controller = $observer->getEvent()->getData('controller_action');
                $this->redirect->redirect($controller->getResponse(), 'customer/account/login');
            }
        }
    }
}
