<?php
namespace Mobilyte\Customtheme2\Block;

class Ques extends \Magento\Framework\View\Element\Template
{
	public function __construct(
								\Magento\Framework\View\Element\Template\Context $context,
								\Magento\Framework\Registry $registry)
	{
		$this->registry = $registry;
		parent::__construct($context);
	}

	public function getAction1(){
		return $this->getUrl(
            'customtheme2/index/index',
            [
            	'id' => $this->getProductId(),
            ]
        );
	}

	protected function getProductId()
    {
         return $this->getRequest()->getParam('id', false);

        //return $this->registry->registry('product');
    }
}