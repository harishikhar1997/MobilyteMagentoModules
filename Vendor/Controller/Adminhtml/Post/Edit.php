<?php

namespace Mobilyte\Vendor\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{

    protected  $postModel;

    protected $_coreRegistry;

   
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Mobilyte\Vendor\Model\Post $postModel,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
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

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This blog no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_coreRegistry->register('vendor_news', $model);
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();



   }
}
