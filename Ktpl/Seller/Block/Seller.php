<?php
namespace Ktpl\Seller\Block;
use Magento\Framework\View\Element\Template;
 
class Seller extends Template
{    
    protected function _prepareLayout()
    {
        
    }
    public function getFormAction()
    {
        return $this->getUrl('seller/index/post');
    }
    public function getFormData() {
        $registryObject = $this->_objectManager->get('Magento\Framework\Registry');
        $seller = $registryObject->registry('seller');
        if($seller)
        {
            return; 
        }
        return $seller;
    }
}