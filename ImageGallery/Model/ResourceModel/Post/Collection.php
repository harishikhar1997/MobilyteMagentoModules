<?php
namespace Mobilyte\ImageGallery\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'post_id';
	protected $_eventPrefix = 'mobilyte_imagegallery_post_collection';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Mobilyte\ImageGallery\Model\Post', 'Mobilyte\ImageGallery\Model\ResourceModel\Post');
	}

}
