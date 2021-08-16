<?php
    
    namespace Amasty\CloneFrdljModule\Observer;
    
    use Magento\Catalog\Api\ProductRepositoryInterface;
    use Magento\Checkout\Model\Session as CheckoutSession;
    use Magento\Framework\Event\Observer;
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\Config\ScopeConfigInterface;
    
    class AddPromoSku implements ObserverInterface
    {
        /**
         * @var CheckoutSession
         */
        protected $checkoutSession;
        
        /**
         * @var ProductRepositoryInterface
         */
        protected $productRepository;
        /**
         * @var ScopeConfigInterface
         */
        protected $ScopeConfig;
        
        public function __construct(
            CheckoutSession            $checkoutSession,
            ProductRepositoryInterface $productRepository,
            ScopeConfigInterface       $ScopeConfig
        )
        {
            $this->checkoutSession = $checkoutSession;
            $this->productRepository = $productRepository;
            $this->ScopeConfig = $ScopeConfig;
        }
        
        public function execute(Observer $observer)
        {
            $promoSku = $this->ScopeConfig->getValue('clonefrdli_config/general/promo_sku');
            $promoProduct = $this->productRepository->get($promoSku);
            
            $addedProduct = $observer->getData('added_promo_product');
            
            $forSku = $this->ScopeConfig->getValue('clonefrdli_config/general/for_sku');
            
            if ($forSku === $addedProduct) {
                $quote = $this->checkoutSession->getQuote();
                $quote->addProduct($promoProduct, 1);
                $quote->save();
            }
        }
    }