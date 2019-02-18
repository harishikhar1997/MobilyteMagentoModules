<?php
namespace Mobilyte\Customtab\Model\ResourceModel;
 
class Customtab extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('customtab', 'id');
    }
}