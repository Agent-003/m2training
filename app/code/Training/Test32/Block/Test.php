<?php

namespace Training\Test32\Block;

class Test extends \Magento\Framework\View\Element\Template
{
    // Можно понизить уровень закрытости или сделать как в оригинальном (protected)
    protected function _toHtml()
    {
        return "<b>Hello world from block!</b>";
    }
}