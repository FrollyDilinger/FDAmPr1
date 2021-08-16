<?php
    
    namespace Amasty\FrdljModule\Model;
    
    use Magento\Framework\Model\AbstractModel;
    
    class BlackListModel extends AbstractModel
    {
        protected function _construct()
        {
            $this->_init(
                ResourceModel\BlackListModel::class
            );
        }
    }
    