<?php

namespace Mobilyte\ImageGallery\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{

    protected  $postModel;

    protected $_coreRegistry;

    protected $_fileUploaderFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Mobilyte\ImageGallery\Model\Post $postModel,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->postModel = $postModel;
        parent::__construct($context);
    }
   /**
     * @return void
     */
   public function execute()
   {
        $id = $this->getRequest()->getParam('id');
        $model = $this->postModel->load($id);

            // $uploader = $this->_fileUploaderFactory->create(['fileId' => 'featured_image']);
      
            // $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
      
            // $uploader->setAllowRenameFiles(false);
      
            // $uploader->setFilesDispersion(false);
 
            // $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)
      
            // ->getAbsolutePath('images/');
      
            // $uploader->save($path);

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This blog no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_coreRegistry->register('imagegallery_gallery', $model);
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();



   }
}
