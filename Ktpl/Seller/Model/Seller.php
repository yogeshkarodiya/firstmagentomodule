<?php
     
namespace Ktpl\Seller\Model;

use Magento\Framework\Model\AbstractModel;

class Seller extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Ktpl\Seller\Model\ResourceModel\Seller');
    }
}