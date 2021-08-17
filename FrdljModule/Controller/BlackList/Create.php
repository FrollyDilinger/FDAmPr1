<?php
    
    namespace Amasty\FrdljModule\Controller\BlackList;
    
    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Amasty\FrdljModule\Model\ResourceModel\BlackListModel as BlackListModelResource;
    use Amasty\FrdljModule\Model\BlackListModelFactory;
    
    class Create extends Action
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
            $blackList = $this->blackListModelFactory->create();
            $blackList->setProduct_sku('24-WB064s');
            $blackList->setProduct_qty(22);
            $this->blackListModelResource->save($blackList);
//            $this->blackRes->load($blackList,1);
//            echo $blackList->getProduct_sku();
            die('done');
        }
    }