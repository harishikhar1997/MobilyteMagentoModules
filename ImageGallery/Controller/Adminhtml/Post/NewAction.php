<?php

namespace Mobilyte\ImageGallery\Controller\Adminhtml\Post;

// use Tutorial\SimpleNews\Controller\Adminhtml\News;

class NewAction extends \Magento\Backend\App\Action
{
	public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Mobilyte\ImageGallery\Model\Post $postModel,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->postModel = $postModel;
        parent::__construct($context);
    }

   /**
     * Create new news action
     *
     * @return void
     */
   public function execute()
   {
      $this->_forward('edit');
   }
}