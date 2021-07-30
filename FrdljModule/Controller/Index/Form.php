<?php
    
    namespace Amasty\FrdljModule\Controller\Index;
    
    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\Controller\ResultFactory;
    use Magento\Checkout\Model\Session as CheckoutSession;
    use Magento\Catalog\Api\ProductRepositoryInterface;
    use Magento\Framework\Exception\NoSuchEntityException;
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
         * @var ManagerInterface
         */
        protected $messageManager;
        
        public function __construct(
            Context                    $context,
            CheckoutSession            $checkoutSession,
            ProductRepositoryInterface $ProductRepository,
            ManagerInterface           $messageManager
        )
        {
            $this->checkoutSession = $checkoutSession;
            $this->ProductRepository = $ProductRepository;
            $this->messageManager = $messageManager;
            parent::__construct($context);
        }
        
        public function execute()
        {
            $post = $this->getRequest()->getPost();
            
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
            
            if ($product->getTypeId() == 'simple') {
                
                $quote->addProduct($product, $post['qty']);
                $quote->save();
                
                $this->messageManager->addSuccessMessage("ok!");
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
