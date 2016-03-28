<?php

namespace Ktpl\Seller\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Seller extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('seller', 'id');
    }
}