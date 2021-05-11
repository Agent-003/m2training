<?php

namespace Training\TestObservers\Observer;

use Magento\Framework\Event\ObserverInterface;

class RedirectToLogin implements ObserverInterface
{

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
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->redirect = $redirect;
        $this->logger = $logger;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');

        $request = $observer->getEvent()->getData('request');

        $this->logger->debug($request->getModuleName());
        $this->logger->debug($request->getControllerName());
        $this->logger->debug($request->getActionName());

        if (!$customerSession->isLoggedIn()) {
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
