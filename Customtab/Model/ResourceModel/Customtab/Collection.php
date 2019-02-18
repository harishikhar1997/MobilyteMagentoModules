<?php 
namespace Mobilyte\Customtab\Model\ResourceModel\Customtab;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection 
{ 
/** * Define resource model 
* * @return void 
*/
protected function _construct() 
{ 
       $this->_init('Mobilyte\Customtab\Model\Customtab', 'Mobilyte\Customtab\Model\ResourceModel\Customtab');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }
 
}