<?php
    
    namespace Amasty\FrdljModule\Ui\Component\Form;
    
    use Magento\Ui\DataProvider\AbstractDataProvider;
    use Amasty\FrdljModule\Model\ResourceModel\BlackListModel\CollectionFactory;
    
    class DataProvider extends AbstractDataProvider
    {
        protected $loadedData;
        
        public function __construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            CollectionFactory $collectionFactory,
            array $meta = [],
            array $data = [])
        {
            $this->collection = $collectionFactory->create();
            parent::__construct(
                $name,
                $primaryFieldName,
                $requestFieldName,
                $meta,
                $data);
        }
        
        public function getData()
        {
            if (!isset($this->loadedData)) {
                $products = $this->collection->getItems();
                foreach ($products as $item) {
                    $this->loadedData[$item->getId()] = $item->getData();
                }
            }
            return $this->loadedData;
        }
    }
