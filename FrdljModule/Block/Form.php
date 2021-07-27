<?php

namespace Amasty\FrdljModule\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;

class Form extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    )
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function isFieldEnabled()
    {
        return $this->scopeConfig->isSetFlag('frdli_config/general/qtyField');
    }

    public function getFieldText()
    {
        return $this->scopeConfig->getValue('frdli_config/general/qtyFieldCount');
    }

    public function getFormAction()
    {
        return $this -> getUrl('FrdljModule/Index/Form');
    }

}
