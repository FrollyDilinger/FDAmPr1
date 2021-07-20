<?php


namespace Amasty\FrdljModule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
public function execute()
{
    //echo "Type new wrllst";
    return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
}
}

