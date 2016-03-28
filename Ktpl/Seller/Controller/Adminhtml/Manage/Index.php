<?php
/**
 *
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
namespace Ktpl\Seller\Controller\Adminhtml\Manage;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Index extends \Magento\Backend\App\Action
{
    
     /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
     //   $resultPage->setActiveMenu('Ashsmith_Blog::post');
        $resultPage->addBreadcrumb(__('Manage Seller'), __('Manage Seller'));
        $resultPage->addBreadcrumb(__('Manage Seller'), __('Manage Seller'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Seller'));

        return $resultPage;
    }
    
    public function _isAllowed() {
        
        return $this->_authorization->isAllowed('Ktpl_Seller::manage');
    }






    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
//    public function execute()
//    {
//		
//
//        if ($this->getRequest()->getQuery('ajax')) {
//            $this->_forward('grid');
//            return;
//        }
//        $this->_view->loadLayout();
//
//        /**
//         * Set active menu item
//         */
//        $this->_setActiveMenu('Ktpl_Seller::items');
//
//        /**
//         * Add breadcrumb item
//         */
//        $this->_addBreadcrumb(__('Seller'), __('Sellers'));
//        $this->_addBreadcrumb(__('Manage Sellers'), __('Manage Seller'));
//
//        $this->_view->renderLayout();
//    }
}
