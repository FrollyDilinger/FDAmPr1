<?php

namespace Amasty\FrdljModule\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    public function chooseYourSoul($name)

    {
        return 'Coose,' . $name . '...';

    }
}
