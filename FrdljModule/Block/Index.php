<?php
    
    namespace Amasty\FrdljModule\Block;
    
    use Magento\Framework\View\Element\Template\Context;
    use Magento\Framework\App\Config\ScopeConfigInterface;
    use Magento\Framework\Event\ManagerInterface as EventManager;
    
    class Index extends \Magento\Framework\View\Element\Template
    {
        /**
         * @var ScopeConfigInterface
         */
        protected $scopeConfig;
        
        /**
         * @var EventManager
         */
        private $EventManager;
        
        public function __construct(
            EventManager         $EventManager,
            Context              $context,
            ScopeConfigInterface $scopeConfig
        )
        {
            $this->EventManager = $EventManager;
            $this->scopeConfig = $scopeConfig;
            parent::__construct($context);
        }
        
        public function getTextInArea()
        {
            return $this->scopeConfig->getValue('frdli_config/general/Hello_text');
        }
    }
