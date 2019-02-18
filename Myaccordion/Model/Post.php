<?php
namespace Mobilyte\Myaccordion\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'mobilyte_myaccordion_post';

	protected $_cacheTag = 'mobilyte_myaccordion_post';

	protected $_eventPrefix = 'mobilyte_myaccordion_post';

	protected function _construct()
	{
		$this->_init('Mobilyte\Myaccordion\Model\ResourceModel\Post');
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