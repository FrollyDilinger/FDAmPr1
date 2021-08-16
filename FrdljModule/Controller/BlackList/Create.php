<?php
    
    namespace Amasty\FrdljModule\Controller\BlackList;
    
    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Amasty\FrdljModule\Model\ResourceModel\BlackListModel as BlackRes;
    use Amasty\FrdljModule\Model\BlackListModelFactory;
    
    class Create extends Action
    {
        /**
         * @var BlackListModelFactory
         */
        
        private $blackListModelFactory;
        /**
         * @var BlackRes
         */
        
        private $blackRes;
        
        
        public function __construct(
            Context               $context,
            BlackListModelFactory $blackListModelFactory,
            BlackRes              $blackRes
        
        )
        {
            parent::__construct($context);
            $this->blackListModelFactory = $blackListModelFactory;
            $this->blackRes = $blackRes;
            
        }
        
        public function execute()
        {
            $blackList = $this->blackListModelFactory->create();
            $blackList->setProduct_sku('24-WB06');
            $blackList->setProduct_qty(22);
            $this->blackRes->save($blackList);
//            $this->blackRes->load($blackList,1);
//            echo $blackList->getProduct_sku();
            die('done');
        }
    }