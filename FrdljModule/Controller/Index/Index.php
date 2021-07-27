<?php

namespace Amasty\FrdljModule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends Action
{
    /**
     * @var ProductRepositoryInterface
     */

    protected $ProductRepository;

    /**
     * @var  CheckoutSession
     */

    protected $checkoutSession;

    /**
     * @var ScopeConfigInterface
     */

    protected $scopeConfig;

    public function __construct(
        Context $context,
        CheckoutSession $checkoutSession,
        ProductRepositoryInterface $ProductRepository,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->ProductRepository = $ProductRepository;
        $this ->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function execute()
    {

        //echo "Type new wrllst";
        if($this->scopeConfig->isSetFlag('frdli_config/general/enabled')){
            return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        } else{
            die('oh, noooo');
        }


    }
}

