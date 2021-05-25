<?php

namespace Training\Task37\Plugin\Block\Product\View;

class DescriptionReplacement
{

    public function beforeToHtml(
        \Magento\Catalog\Block\Product\View\Description $subject,
        $data = null
    ) {

        //$subject->setTemplate('Training_Task37::description.phtml');

        // Или такой вариант, если только для description 
        $subject->getLayout()->getBlock('product.info.description')->setTemplate('Training_Task37::description.phtml');

        if ($subject->getNameInLayout() == 'product.info.sku') {
            $subject->setTemplate('Training_Task37::description-sku.phtml');
        }

        return $data;
    }
}
