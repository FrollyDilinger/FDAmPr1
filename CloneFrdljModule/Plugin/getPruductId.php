<?php
    
    namespace Amasty\CloneFrdljModule\Plugin;
    
    use Magento\Catalog\Api\ProductRepositoryInterface;
    use Magento\Framework\App\RequestInterface;
    use Magento\Framework\Event\ManagerInterface as EventManager;
    use Magento\Framework\Message\ManagerInterface;
    
    class getPruductId
    {
        /**
         * @var ProductRepositoryInterface
         */
        private $productRepository;
        
        /**
         * @var RequestInterface
         */
        private $request;
        /**
         * @var EventManager
         */
        private $eventManager;
        
        /**
         * @var ManagerInterface
         */
        private $messageManager;
        
        public function __construct(
            ProductRepositoryInterface $productRepository,
            RequestInterface           $request,
            EventManager               $eventManager,
            ManagerInterface           $messageManager
        )
        {
            $this->productRepository = $productRepository;
            $this->request = $request;
            $this->eventManager = $eventManager;
            $this->messageManager = $messageManager;
        }
        
        public function beforeExecute($subject)
        {
            $this->request->getParam('qty');
            $productSku = $this->request->getParam('sku');

            $productId = $this->productRepository->get($productSku)->getId();
            
            $this->request->setParam('product', $productId);
            
        }
    }
