<?php

namespace Ktpl\Seller\Model\ResourceModel\Seller;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Ktpl\Seller\Model\Seller',
            'Ktpl\Seller\Model\ResourceModel\Seller'
        );
    }
}