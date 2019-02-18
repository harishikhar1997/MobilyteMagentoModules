<?php

namespace Mobilyte\Pinvoice\Model;

class Grid extends \Magento\Framework\Model\AbstractModel
{
   
    protected function _construct()
    {
        $this->_init('Mobilyte\Pinvoice\Model\ResourceModel\Grid');
    }
    
}
