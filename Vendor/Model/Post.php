<?php
namespace Mobilyte\Vendor\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'vendor_registration';

	protected $_cacheTag = 'vendor_registration';

	protected $_eventPrefix = 'vendor_registration';

	protected function _construct()
	{
		$this->_init('Mobilyte\Vendor\Model\ResourceModel\Post');
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