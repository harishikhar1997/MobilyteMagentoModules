<?php
namespace Mobilyte\ImageGallery\Block;

class Gallery extends \Magento\Framework\View\Element\Template
{
	protected $_postFactory;

	protected $templateProcessor;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Mobilyte\ImageGallery\Model\PostFactory $postFactory,
		\Magento\Store\Model\StoreManagerInterface $storeManager
	)
	{
		$this->_postFactory = $postFactory;
		$this->storeManager = $storeManager;
		parent::__construct($context);
	}

	public function getPostCollection(){
		$post = $this->_postFactory->create();
		return $post->getCollection()->getData();
	}

	public function getMediaPath() {
		return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
	}

}

