<?php
namespace Mobilyte\Customtheme2\Block;

class Faq extends \Magento\Framework\View\Element\Template{

	public function __construct(
					\Magento\Framework\View\Element\Template\Context $context,
					\Magento\Framework\Registry $registry,
					\Mobilyte\Customtheme2\Model\DataFactory $dataFactory,
					\Mobilyte\Customtheme2\Model\ResourceModel\Data\Collection $collection)
	{
		$this->registry = $registry;
		$this->collection=$collection;
		$this->dataFactory=$dataFactory;
		parent::__construct($context);
	}


	public function getCurrentProduct()
    {        
        return $this->registry->registry('current_product');
    }
	
	public function getDataCollection(){
		// $data = $this->dataFactory->create();
		// return $data->getCollection()->getData();

		return $this->collection->addFieldToFilter('product_id',$this->getCurrentProduct()->getId())->addFieldToFilter('status',1);

	}    

}