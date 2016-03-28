<?php
namespace Ktpl\Seller\Controller\Index;
use Magento\Framework\App\Action\Context;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
 
class Post extends \Magento\Framework\App\Action\Action
{
    
    public function __construct(Context $context,UploaderFactory $fileUploaderFactory,Filesystem $filesystem)
    {
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_filesystem = $filesystem;
        return parent::__construct($context);
    }
 
    public function execute()
    {        
        $post = $this->getRequest()->getPostValue();
        if (!$post) {
            $this->_redirect('*/*/');
            return;
        }
        try{
            $uploader = $this->_fileUploaderFactory->create(['fileId' => 'imagename']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(true);
            $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)
            ->getAbsolutePath('seller/');
            $result = $uploader->save($path);
            $post["imagename"] = $result['file'];
            $model = $this->_objectManager->create('Ktpl\Seller\Model\Seller');
            $model->setData($post);
//            echo '<pre>';
//            print_r($model->getData());
//            die();
            $model->save();
            $this->messageManager->addSuccess(
                __('Seller information has been saved successfully.')
            );
            $this->_redirect('*/*/show');
            return;
            
        } catch (Exception $ex) {
             $this->messageManager->addError(
                __('Please try again.')
            );
            $this->_redirect('*/*/show');
            return;
        }
        
    }    
}