<?php

namespace Ktpl\Seller\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Ktpl\Seller\Model\SellerFactory;

class Show extends Action
{
    /**
     * @var \Tutorial\SimpleNews\Model\NewsFactory
     */
    protected $_modelsellerFactory;
     protected $pageFactory;
     protected $registry;
    /**
     * @param Context $context
     * @param NewsFactory $modelNewsFactory
     */
    public function __construct(
        Context $context,
        SellerFactory $modelSellerFactory, PageFactory $pageFactory,Registry $registry
    ) {
        $this->pageFactory = $pageFactory;
        $this->registry = $registry;
        parent::__construct($context);
        $this->_modelsellerFactory = $modelSellerFactory;
    }

    public function execute()
    {
        /**
         * When Magento get your model, it will generate a Factory class
         * for your model at var/generaton folder and we can get your
         * model by this way
         */
        $sellerModel = $this->_modelsellerFactory->create();

        // Load the item with ID is 1
//        $item = $newsModel->load(1);
//        var_dump($item->getData());

        // Get news collection
        $sellerCollection = $sellerModel->getCollection();
        // Load all data of collection
        $this->registry->register('sellerdata', $sellerCollection->getData());
//        var_dump($sellerCollection->getData());
//        die();
        $page_object = $this->pageFactory->create();;
        return $page_object;
    }
     
}