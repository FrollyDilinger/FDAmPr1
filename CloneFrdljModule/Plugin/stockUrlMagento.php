<?php
    
    namespace Amasty\CloneFrdljModule\Plugin;
    
    
    class stockUrlMagento
    {
       const STOCK_CART_MG2 = 'checkout/cart/add';
    
        public function afterGetFormAction($subject, $result)
        {
            return self::STOCK_CART_MG2;
        }
    }
  