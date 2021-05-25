<?php

namespace Training\Render\Controller\Layout;

class Onecolumn implements \Magento\Framework\App\Action\HttpGetActionInterface
{

    private $resultPageFactory;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
