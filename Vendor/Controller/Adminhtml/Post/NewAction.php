<?php

namespace Mobilyte\Vendor\Controller\Adminhtml\News;


class NewAction extends \Magento\Backend\App\Action
{
   /**
     * Create new news action
     *
     * @return void
     */
   public function execute()
   {
      $this->_forward('edit');
   }
}
