<?php

namespace Mobilyte\Myinvoice\Model;

class Grid extends \Magento\Framework\Model\AbstractModel
{
   
    protected function _construct()
    {
        $this->_init('Mobilyte\Myinvoice\Model\ResourceModel\Grid');
    }
    
}
