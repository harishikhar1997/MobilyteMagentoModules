<?php

namespace Mobilyte\Myinvoice\Model\ResourceModel\Count;

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
            'Mobilyte\Myinvoice\Model\Count',
            'Mobilyte\Myinvoice\Model\ResourceModel\Count'
        );
    }
}
