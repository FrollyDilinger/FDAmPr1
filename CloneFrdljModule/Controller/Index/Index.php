<?php
    
    namespace Amasty\CloneFrdljModule\Controller\Index;
    
    use Magento\Framework\App\Action\Action;
    use Magento\Customer\Model\Session;
    use Magento\Framework\App\Config\ScopeConfigInterface;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\Controller\ResultFactory;
    
    class Index extends Action
    {
        /**
         * @var Session
         */
        private $customerSession;
        
        /**
         * @var ScopeConfigInterface
         */
        protected $scopeConfig;
        
        public function __construct(
            Session $customerSession,
            Context $context
        )
        {
            $this->customerSession = $customerSession;
            parent::__construct($context);
        }
        
        public function execute()
        {
            if ($this->customerSession->isLoggedIn())
            {
                return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
                
            } else {
                $this->messageManager->addErrorMessage("Idi registration delay, bober");
                $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
                $resultRedirect->setUrl('http://magento.loc');
                return $resultRedirect;
            }
        }
    }