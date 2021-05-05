<?php

namespace Training\Test\Plugin\Block;

class Template
{
    public function afterToHtml(
        \Magento\Framework\View\Element\Template $subject,
        $result
    ) {

        if ($subject->getNameInLayout() == 'top.search') {

            $result = '<div><hr>
                        <p>' . $subject->getTemplate() . '</p>'
                     . '<p>' . get_class($subject) . '</p><hr>' . $result . '</div>';
        }

        return $result;
    }
}
