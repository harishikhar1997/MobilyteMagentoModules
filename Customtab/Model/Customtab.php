<?php 
namespace Mobilyte\Customtab\Model;
 
class Customtab extends \Magento\Framework\Model\AbstractModel
{ 
/** * Initialize resource model
 * * @return void
 */
protected function _construct()
 { 
   $this->_init('Mobilyte\Customtab\Model\ResourceModel\Customtab');
 }
}