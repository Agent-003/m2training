<?php

namespace Training\Test24\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\RawFactory;

class Index implements ActionInterface
{

    public function __construct(
        RawFactory $resultRawFactory
    ) {
        $this->resultRawFactory = $resultRawFactory;
    }

    public function execute()
    {
        $resultRaw = $this->resultRawFactory->create();
        $resultRaw->setContents('simple text');
        return $resultRaw;
    }
}
