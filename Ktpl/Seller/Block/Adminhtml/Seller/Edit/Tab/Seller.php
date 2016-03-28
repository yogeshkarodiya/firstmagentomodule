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
namespace Ktpl\Seller\Block\Adminhtml\Seller\Edit\Tab;

/**
 * Cms page edit form main tab
 */
class Seller extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = array()
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /* @var $model \Magento\Cms\Model\Page */
        $model = $this->_coreRegistry->registry('seller');
		$isElementDisabled = false;
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend' => __('Seller Information')));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }

        $fieldset->addField(
            'firstname',
            'text',
            array(
                'name' => 'firstname',
                'label' => __('Firstname'),
                'title' => __('Firstname'),
                'required' => true,
               
            )
        );
        $fieldset->addField(
            'lastname',
            'text',
            array(
                'name' => 'lastname',
                'label' => __('Lastname'),
                'title' => __('Lastname'),
                'required' => true,
               
            )
        );
        $fieldset->addField(
            'email',
            'text',
            array(
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email'),
                'required' => true,
            )
        );
         $fieldset->addField(
            'telephone',
            'text',
            array(
                'name' => 'telephone',
                'label' => __('Telephone'),
                'title' => __('Telephone'),
            )
        );
        $fieldset->addField(
            'city',
            'text',
            array(
                'name' => 'city',
                'label' => __('City'),
                'title' => __('City'),
            )
        );
       
		$fieldset->addField(
            'imagename',
            'image',
            array(
                'name' => 'imagename',
                'label' => __('Image'),
                'title' => __('Image'),
                'required' => true,
            )
        );

        

        $this->_eventManager->dispatch('adminhtml_cms_page_edit_tab_main_prepare_form', array('form' => $form));
		if($model->getData('imagename'))
			$model->setData('imagename','pub/media/seller/images'.$model->getData('imagename'));
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Seller Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Seller Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
