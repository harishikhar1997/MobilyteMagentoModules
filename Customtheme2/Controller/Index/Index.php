<?php
namespace Mobilyte\Customtheme2\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;


class Index extends Action
{
    protected $dataModelFactory;
    protected $_productloader;

    public function __construct(
                            Context $context,
                            \Magento\Customer\Model\Session $customerId,
                            \Mobilyte\Customtheme2\Model\DataFactory $dataModelFactory,
                            \Mobilyte\Customtheme2\Model\ResourceModel\Data\Collection $dataModel,
                            \Magento\Catalog\Model\ProductFactory $_productloader,
                            array $arr=[])
    {
        parent::__construct($context,$arr);
        $this->dataModelFactory = $dataModelFactory;
        $this->dataModel = $dataModel;
        $this->customerId = $customerId;
        $this->_productloader = $_productloader;
    }

    public function execute()
    {
        //echo "HEllo World";
    
        $data=$this->dataModelFactory->create();

        $customerId=$this->customerId->getCustomerId();

        $arr = $this->getRequest()->getParams();

        // $product = $this->productFactory->create();
        // $sku=$product->load($product->getIdBySku($sku));

        $sku= $this->_productloader->create()->load($arr['id']);

        //print_r($sku->getSku());
        // echo "<pre>";
        // print_r($arr);
         // exit();

        $data->setProductId($arr['id']);
        $data->setSku($sku->getSku());
        //$data->setSKU($arr['sku']);
        $data->setQuestion($arr['question']);
        $data->setCustomerId($customerId);
        // $data->setSKU($sku);
        $data->save();

        //print_r($data->getData());exit();
        
        $this->messageManager->addSuccess(__("Question has been submitted successfully."));


        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;


    }
}