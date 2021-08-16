<?php
    
    namespace Amasty\FrdljModule\Model\ResourceModel\BlackListModel;
    
    
    use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
    use Amasty\FrdljModule\Model\BlackListModel;
    use Amasty\FrdljModule\Model\ResourceModel\BlackListModel as BlModRes;
    
    class Collection extends AbstractCollection
    {
        protected function _construct()
        {
            $this->_init(
                BlackListModel::class,
                BlModRes::class
            );
        }
    }