<?php
namespace Mobilyte\ImageGallery\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'mobilyte_imagegallery_post';

	protected $_cacheTag = 'mobilyte_imagegallery_post';

	protected $_eventPrefix = 'mobilyte_imagegallery_post';

	protected function _construct()
	{
		$this->_init('Mobilyte\ImageGallery\Model\ResourceModel\Post');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}