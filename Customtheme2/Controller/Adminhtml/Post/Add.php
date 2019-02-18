<?php
namespace Mobilyte\Customtheme2\Controller\Adminhtml\Post;
 
use Magento\Framework\Controller\ResultFactory;
 
class Add extends \Magento\Backend\App\Action
{
    private $coreRegistry;
    private $dataFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Mobilyte\Customtheme2\Model\DataFactory $dataFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->dataFactory = $dataFactory;
    }
 

    public function execute()
    {
        $rowId =  $this->getRequest()->getParam('id');
       // print_r($rowId);exit();    //it simply returns the id of element in our table
        $rowData = $this->dataFactory->create();
        // print_r($rowData->getData());exit();
        if ($rowId) {
           $rowData = $rowData->load($rowId);
           $rowTitle = $rowData->getTitle();

          print_r($rowData->getData());exit();
           
           if (!$rowData->getEntityId()) {
               $this->messageManager->addError(__('Query no longer exist.'));
               $this->_redirect('customtheme2/post/add');
               return;
           }
       }
 
       $this->coreRegistry->register('row_data', $rowData);
       $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
       $resultPage->getConfig()->getTitle()->prepend('Answer The Query Here.');
       return $resultPage;
    }    
}