<?php
namespace Mobilyte\Customtheme2\Controller\Adminhtml\Post;
 
class Save extends \Magento\Backend\App\Action
{
    var $gridFactory;
 
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Mobilyte\Customtheme2\Model\DataFactory $gridFactory
    ) {
        parent::__construct($context);
        $this->gridFactory = $gridFactory;
    }
 
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('customtheme2/post/add');
            return;
        }
        try {
            $rowData = $this->gridFactory->create();


            $rowData->setData($data);
            
            //print_r($rowData->getData());exit();

            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);

             
            }

            $rowData->save();
            $this->messageManager->addSuccess(__('Your reply has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('customtheme2/post/post');
    }
 
}