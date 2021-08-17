<?php
    
    namespace Amasty\FrdljModule\Controller\Adminhtml\Blacklist;
    
    use Magento\Backend\App\Action;
    use Magento\Backend\App\Action\Context;
    use Amasty\FrdljModule\Model\ResourceModel\BlackListModel as BlackListModelResource;
    use Amasty\FrdljModule\Model\BlackListModelFactory;
    
    
    class Save extends Action
    {
        /**
         * @var BlackListModelFactory
         */
        private $blackListModelFactory;
        
        /**
         * @var BlackListModelResource
         */
        private $blackListModelResource;
        
        public function __construct(
            Context                $context,
            BlackListModelFactory  $blackListModelFactory,
            BlackListModelResource $blackListModelResource
        )
        {
            parent::__construct($context);
            $this->blackListModelFactory = $blackListModelFactory;
            $this->blackListModelResource = $blackListModelResource;
        }
        
        public function execute()
        {
            if ($data = $this->getRequest()->getParams()) {
                $productId = $this->getRequest()->getParam('product_id');
                try {
                    $product = $this->blackListModelFactory->create();
                    if ($productId) {
                        $this->blackListModelResource->load($product, $productId);
                    }
                    $product->addData($data);
                    $this->blackListModelResource->save($product);
                    $this->messageManager->addSuccessMessage(__('  add to cart.'));
                } catch (\Exception $exception) {
                    $this->messageManager->addExceptionMessage($exception, $exception->getMessage());
                }
            }
            return $this->_redirect('*/*/index');
        }
    }