<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customer grid block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Ktpl\Seller\Block\Adminhtml\Seller;
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
   public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Ktpl\Seller\Model\SellerFactory $sellerFactory,
	\Ktpl\Seller\Model\Seller $seller,
        array $data = array()
    ) {
       
        $this->_sellerFactory = $sellerFactory;
		$this->_seller = $seller;
        parent::__construct($context, $backendHelper, $data);
    }
   protected function _construct()
    {
       
        parent::_construct();
        $this->setId('sellerGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {	
	$collection = $this->_sellerFactory->create()->getCollection();
	
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            array(
                'header' => __('Seller ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            )
        );
        $this->addColumn(
            'firstname',
            array(
                'header' => __('Firstname'),
                'index' => 'firstname',
                'class' => 'xxx'
            )
        );
        $this->addColumn(
            'lastname',
            array(
                'header' => __('Lastname'),
                'index' => 'lastname',
                'class' => 'xxx'
            )
        );
        $this->addColumn(
            'email',
            array(
                'header' => __('Email'),
                'index' => 'email',
                'class' => 'xxx'
            )
        );
        $this->addColumn(
            'telephone',
            array(
                'header' => __('Telephone'),
                'index' => 'telephone',
                'class' => 'xxx'
            )
        );
        $this->addColumn(
            'city',
            array(
                'header' => __('City'),
                'index' => 'city',
                'class' => 'xxx'
            )
        );
		/* $this->addColumn(
            'imagename',
            array(
                'header' => __('Image'),
                'index' => 'imagename',
                'class' => 'xxx'
            )
        );
                 * */
                 
		
		$this->addColumn(
            'edit',
            array(
                'header' => __('Edit'),
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => __('Edit'),
                        'url' => array(
                            'base' => '*/*/edit',
                            'params' => array('store' => $this->getRequest()->getParam('store'))
                        ),
                        'field' => 'id'
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'header_css_class' => 'col-action',
                'column_css_class' => 'col-action'
            )
        );
        

        return parent::_prepareColumns();
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('seller');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => __('Delete'),
                'url' => $this->getUrl('selleradmin/*/massDelete'),
                'confirm' => __('Are you sure?')
            )
        );

       

     
      
        return $this;
    }

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('seller/*/grid', array('_current' => true));
    }
    public function getRowUrl($row)
    {
        return $this->getUrl(
            'seller/*/edit',
            array('store' => $this->getRequest()->getParam('store'), 'id' => $row->getId())
        );
    }
}
