<?php

namespace Amasty\FrdljModule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Message\ManagerInterface;

class Form extends Action
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

    /**
     * @var ManagerInterface
     */

    protected $messageManager;

    public function __construct(
        Context $context,
        CheckoutSession $checkoutSession,
        ProductRepositoryInterface $ProductRepository,
        ScopeConfigInterface $scopeConfig,
        ManagerInterface $messageManager
    )
    {
        $this->checkoutSession = $checkoutSession;
        $this->ProductRepository = $ProductRepository;
        $this->scopeConfig = $scopeConfig;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {

        $post = $this->getRequest()->getPost();

        if (!empty($post)) {

            $product = $post['sku'];
            $quote = $post['qty'];


            $this->ProductRepository->get($product);
            $this->checkoutSession->getQuote();

            if (!$quote->getId()) {
                $quote->save();
            }

            $quote->addProduct($product, $quote);
            $quote->save();

            $this->messageManager->addSuccessMessage('add to cart !');


        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setUrl('/Amasty/FrdljModule/');

        return $resultRedirect;


        }
    }
}
