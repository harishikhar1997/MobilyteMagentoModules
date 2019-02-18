<?php

namespace Mobilyte\ImageGallery\Controller\Adminhtml\Post;


class Save extends \Magento\Backend\App\Action
{

   protected $postModelFactory;
   protected $_fileUploaderFactory;

   public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Mobilyte\ImageGallery\Model\Post $postModel,
        \Mobilyte\ImageGallery\Model\PostFactory $postModelFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploader,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\Image\AdapterFactory $adapterFactory
    ) {
        $this->postModelFactory = $postModelFactory;
        $this->_coreRegistry = $coreRegistry;

        $this->uploader = $uploader;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        
        $this->postModel = $postModel;
        parent::__construct($context);
    }


   /**
     * @return void
     */
   public function execute()
   {
      $post = $this->getRequest()->getPost();
         $postValues = $post['gallery'];
         $model = '';
         if(isset($postValues['id'])){
            $model = $this->postModel->load($postValues['id']);
         }else{
            $model = $this->postModelFactory->create();
         }
            $model->setName($postValues['name']);
            $model->setPostDescription($postValues['post_description']);
            
            //$model->setFeaturedImage($postValues['featured_image']);
            
            try{
              $base_media_path='images';
              $uploader = $this->uploader->create(['fileId' => 'featured_image']);
              $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
              $imageAdapter = $this->adapterFactory->create();
              $uploader->addValidateCallback('featured_image', $imageAdapter, 'validateUploadFile');
              $uploader->setAllowRenameFiles(true);
              $uploader->setFilesDispersion(true);
              $mediaDirectory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
              $result = $uploader->save(
              $mediaDirectory->getAbsolutePath($base_media_path));
              $data['featured_image'] = $base_media_path.$result['file'];

              $model->setFeaturedImage($data['featured_image']);
            }
            catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
          }



         try
         {
            $model->save();         

            $this->messageManager->addSuccess(__('The post has been saved.'));

            


            // Check if 'Save and Continue'
            if ($this->getRequest()->getParam('back')) {
               $this->_redirect('*/*/edit', ['id' => $this->postModel->getId(), '_current' => true]);
               return;
            }else{
               $this->_redirect('*/*/');
               return;   
            }
            
         }
         catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
         }


    }
}