<?php

namespace Mobilyte\Customtheme2\Model\ResourceModel\Data;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'Mobilyte\Customtheme2\Model\Data',
            'Mobilyte\Customtheme2\Model\ResourceModel\Data'
        );
    }
}