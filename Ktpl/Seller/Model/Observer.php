<?php
namespace Ktpl\Seller\Model;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Observer
{
    
    protected $_objectManager;
    protected $_filesystem;
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,Filesystem $filesystem
    ) {
        $this->_objectManager = $objectManager;
        $this->_filesystem = $filesystem;
      }
    public function sellerconvert(\Magento\Framework\Event\Observer $observer)
    {  
       $customer = $observer->getEvent()->getCustomer();
        $sellerdata = array();
        $sellerdata["firstname"] = $customer->getFirstname();
        $sellerdata["lastname"]  = $customer->getLastname();
        $sellerdata["email"]     = $customer->getEmail();  
        try
        {
            $model = $this->_objectManager->create('Ktpl\Seller\Model\Seller');
            $model->setData($sellerdata);
            $model->save();
        } catch (Exception $ex) {
           

        }
        
    }
    public function qrcodecheck(\Magento\Framework\Event\Observer $observer)
    {
        $_product = $observer->getEvent()->getProduct();
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setHeight(256);
        $renderer->setWidth(256);
        $writer = new \BaconQrCode\Writer($renderer);
       
        $mediadir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)
            ->getAbsolutePath('qrcode/');
        
        $imagepath = $mediadir . $_product->getSku() . ".png";
        
        if (!file_exists($imagepath)) {
           
            $productinfo = "name:" . $_product->getName() . "<br/>";
            $productinfo .= "url:" . $_product->getProductUrl() . "<br/>";
            $productinfo .= "sku:" . $_product->getSku() . "<br/>";
            $writer->writeFile($productinfo, $imagepath);
            $_product->addImageToMediaGallery($imagepath, null, false, false);
            $_product->save();
        }
        
        
    }
}