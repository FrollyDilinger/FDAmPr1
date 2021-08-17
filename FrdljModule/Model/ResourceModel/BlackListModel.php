<?php
    
    namespace Amasty\FrdljModule\Model\ResourceModel;
    
    use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
    
    class BlackListModel extends AbstractDb
    {
    protected function _construct()
    {
        $this->_init(
            'Amasty_FrdljModule_blacklist',
            'product_id'
        );
    }
    }