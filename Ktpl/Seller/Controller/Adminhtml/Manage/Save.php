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
use Magento\Framework\App\Filesystem\DirectoryList;
class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
public function execute()
    {
        //$data = $this->getRequest()->getPost();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $model = $this->_objectManager->create('Ktpl\Seller\Model\Seller');
                        if(isset($_FILES['imagename']['name']) && $_FILES['imagename']['name'] != '') {
				try {
                                    

					   // $uploader = $this->_objectManager->create('Magento\Core\Model\File\Uploader', array('fileId' => 'image'));
                        $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader', ['fileId' => 'imagename']);

						$uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
						$uploader->setAllowRenameFiles(true);
						$uploader->setFilesDispersion(true);
						$mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
							->getDirectoryRead(DirectoryList::MEDIA);
						$config = $this->_objectManager->get('Ktpl\Seller\Model\Seller');
						$result = $uploader->save($mediaDirectory->getAbsolutePath('seller/images'));
						unset($result['tmp_name']);
						unset($result['path']);
						$data['imagename'] = $result['file'];

				} catch (Exception $e) {
					$data['image'] = $_FILES['imagename']['name'];
				}
			}
			else{
				 $data['imagename'] = $data['imagename']['value'];
			}

			$id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }

            $model->setData($data);
            try {
                $model->save();
                $this->messageManager->addSuccess(__('The seller has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId(), '_current' => true));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (\Magento\Framework\Model\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the seller.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }
        $this->_redirect('*/*/');
    }
    public function _isAllowed() {
        
        return $this->_authorization->isAllowed('Ktpl_Seller::save');
    }
}
