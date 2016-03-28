<?php
namespace Ktpl\Seller\Block;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;

 

class Show extends Template
{    
     public function __construct(
        Template\Context $context,
        Registry $registry,array $data = []
    ) {
        
        $this->registry = $registry;
        parent::__construct($context,$data);
    }
    protected function _prepareLayout()
    {
        
    }
    public function getSellerColl() {
         return $this->registry->registry('sellerdata');
    }
   public function getImage($imagepath) {

        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            );
		return $mediaUrl."seller" . $imagepath;
    }
}