<?php
namespace Mobilyte\Myaccordion\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'mobilyte_myaccordion_post_collection';
	protected $_eventObject = 'post_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Mobilyte\Myaccordion\Model\Post', 'Mobilyte\Myaccordion\Model\ResourceModel\Post');
	}

}