<?php

namespace Training\ChangeProductDescription\Plugin\Block\Product\View;

class Description
{
    public function beforeToHtml(
        \Magento\Catalog\Block\Product\View\Description $subject
    ) {
        if ($subject->getProduct()->getDescription()) {
            $subject->getProduct()->setDescription('Test description(from plugin)');
        }
    }
}
