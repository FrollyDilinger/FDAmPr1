<?php
    
    
    namespace Amasty\FrdljModule\Model;

    use Amasty\FrdljModule\Model\ResourceModel\BlackListModel as BlackListModelResource;
    use Amasty\FrdljModule\Model\BlackListModelFactory;
    
    class BlacklistRepository
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
            BlackListModelFactory $blackListModelFactory,
            BlackListModelResource        $blackListModelResource
        )
        {
            $this->blackListModelFactory = $blackListModelFactory;
            $this->blackListModelResource = $blackListModelResource;
        }
        
        public function getById($id)
        {
            $blackList= $this->blackListModelFactory->create();
            $this->blackListModelResource->load($blackList, $id);
            
            return $blackList;
        }
        
        public function deleteById($id)
        {
            $blackList = $this->getById($id);
            $this->blackListModelResource->delete($blackList);
        }
    }