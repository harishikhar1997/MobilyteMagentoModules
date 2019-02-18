<?php

namespace Mobilyte\Vendor\Controller\Adminhtml\Post;


class Save extends \Magento\Backend\App\Action
{

   protected $postModelFactory;

   public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Mobilyte\Vendor\Model\Post $postModel,
        \Mobilyte\Vendor\Model\PostFactory $postModelFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->postModelFactory = $postModelFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->postModel = $postModel;
        parent::__construct($context);
    }

   /**
     * @return void
     */
   public function execute()
   {
      $post = $this->getRequest()->getPost();


       //var_dump($post);exit();
      // if ($isPost) {
      //    $newsModel = $this->_newsFactory->create();
      //    $newsId = $this->getRequest()->getParam('id');





   //       if ($newsId) {
   //          $newsModel->load($newsId);
   //       }
   //       $formData = $this->getRequest()->getParam('news');
   //       $newsModel->setData($formData);
         
   //       try {
   //          // Save news
   //          $newsModel->save();

   //          // Display success message
            // $this->messageManager->addSuccess(__('The news has been saved.'));

            // // Check if 'Save and Continue'
            // if ($this->getRequest()->getParam('back')) {
            //    $this->_redirect('*/*/edit', ['id' => $newsModel->getId(), '_current' => true]);
            //    return;
            // }

   //          // Go to grid page
            // $this->_redirect('*/*/');
            // return;
         // } catch (\Exception $e) {
         //    $this->messageManager->addError($e->getMessage());
         // }

   //       $this->_getSession()->setFormData($formData);
   //       $this->_redirect('*/*/edit', ['id' => $newsId]);
   //    }
         // echo "<pre>";
         // var_dump($post);exit;
         $postValues = $post['news'];
         $model = '';
         if(isset($postValues['id'])){
            $model = $this->postModel->load($postValues['id']);
         }else{
            $model = $this->postModelFactory->create();
         // var_dump($model->getData());exit;
         }
            $model->setName($postValues['name']);
            $model->setEmailId($postValues['email_id']);
            $model->setCountry($postValues['country']);
            $model->setStatus($postValues['status']);
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