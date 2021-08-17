<?php
    
    namespace Amasty\FrdljModule\Controller\Index;
    
    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\Controller\ResultFactory;
    use Magento\Checkout\Model\Session as CheckoutSession;
    use Magento\Catalog\Api\ProductRepositoryInterface;
    use Magento\Framework\Exception\NoSuchEntityException;
    use Magento\Framework\Message\ManagerInterface;
    use Magento\Framework\Event\ManagerInterface as EventManager;
    use Amasty\FrdljModule\Model\ResourceModel\BlackListModel as BlackListModelResource;
    use Amasty\FrdljModule\Model\BlackListModelFactory;
    
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
         * @var ManagerInterface
         */
        protected $messageManager;
        
        /**
         * @var EventManager
         */
        private $eventManager;
        
        /**
         * @var BlackListModelFactory
         */
        private $blackListModelFactory;
        
        /**
         * @var BlackListModelResource
         */
        private $blackListModelResource;
        
        public function __construct(
            Context                    $context,
            CheckoutSession            $checkoutSession,
            ProductRepositoryInterface $ProductRepository,
            ManagerInterface           $messageManager,
            EventManager               $eventManager,
            BlackListModelFactory      $blackListModelFactory,
            BlackListModelResource                   $blackListModelResource
        )
        {
            $this->checkoutSession = $checkoutSession;
            $this->ProductRepository = $ProductRepository;
            $this->messageManager = $messageManager;
            $this->eventManager = $eventManager;
            
            parent::__construct($context);
            $this->blackListModelFactory = $blackListModelFactory;
            $this->blackListModelResource = $blackListModelResource;
        }
        
        public function execute()
        {
            $post = $this->getRequest()->getPost();
            $product = $this->ProductRepository->get($post['sku']);
            
            $this->eventManager->dispatch(       // триггерим событие
                'add_promo_sku',  // имя события
                ['added_promo_product' => $product]       // данные, которые мы передаём
            );
            
            $quote = $this->checkoutSession->getQuote();
            if (!$quote->getId()) {
                $quote->save();
            }
            try {
                $product = $this->ProductRepository->get($post['sku']);
                
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage("Pituk? chto vvodish");
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setUrl('http://magento.loc/standark');
                
                return $resultRedirect;
            }
            
            $blackList = $this->blackListModelFactory->create();
            $this->blackListModelResource->load(
                $blackList,
                $post['sku'],
                'product_sku'
            );
            
            if ($product->getTypeId() == 'simple') {
                if ($post['sku'] === $blackList->getProductSku()) {
                    if ($post['qty'] <= $blackList->getProduct_qty()) {
                        $quote->addProduct($product, $post['qty']);
                        $quote->save();
                        $this->messageManager->addSuccessMessage("black item in cart in cart,");
                    } else {
                        $this->messageManager->addErrorMessage("This position is not available now");
                    }
                } else {
                    $quote->addProduct($product, $post['qty']);
                    $quote->save();
                    
                    $this->messageManager->addSuccessMessage("item in cart,(v korzine on)->up here ");
                }
                
            } else {
                $this->messageManager->addErrorMessage("Prosil. Je. Simple");
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setUrl('http://magento.loc/standark');
                
                return $resultRedirect;
            }
            
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('http://magento.loc/standark');
            
            return $resultRedirect;
        }
    }
    
