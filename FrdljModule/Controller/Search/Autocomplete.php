<?php
    
    namespace Amasty\FrdljModule\Controller\Search;
    
    use Magento\Catalog\Api\ProductRepositoryInterface;
    use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\Controller\Result\JsonFactory;
    
    class Autocomplete extends Action
    {
        /**
         * @var ProductRepositoryInterface
         */
        private ProductRepositoryInterface $productRepository;
        /**
         * @var CollectionFactory
         */
        private CollectionFactory $productCollectionFactory;
        /**
         * @var JsonFactory
         */
        private JsonFactory $jsonResultFactory;
        
        public function __construct(
            Context                    $context,
            ProductRepositoryInterface $productRepository,
            CollectionFactory          $productCollectionFactory,
            JsonFactory                $jsonResultFactory
        )
        {
            parent::__construct($context);
            $this->productRepository = $productRepository;
            $this->productCollectionFactory = $productCollectionFactory;
            $this->jsonResultFactory = $jsonResultFactory;
        }
        
        public function execute()
        {
            $result = $this->jsonResultFactory->create();
            $result->setData($this->getNameAndSku());
            return $result;
        }
        
        public function getNameAndSku(): array
        {
            $sku = $this->getRequest()->getParam('sku');
            $productCollection = $this->productCollectionFactory->create();
            $productCollection->addAttributeToSelect(['name']);
            $productCollection->addAttributeToFilter('sku', ['like' => "%$sku%"]);
            $productCollection->setPageSize(8);
            $items = [];
            foreach ($productCollection as $product) {
                $items[] = $product->getData();
            }
            return $items;
        }
    }