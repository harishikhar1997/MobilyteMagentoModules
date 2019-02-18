<?php
namespace Mobilyte\Customtheme2\Block\Adminhtml\Post;
 
class Add extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $_coreRegistry = null;
 
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) 
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
 
    protected function _construct()
    {
        $this->_objectId = 'row_id';
        $this->_blockGroup = 'Mobilyte_Customtheme2';
        $this->_controller = 'adminhtml_post';
        parent::_construct();
        if ($this->_isAllowedAction('Mobilyte_Customtheme2::add')) {
            $this->buttonList->update('save', 'label', __('Save'));
        } else {
            $this->buttonList->remove('save');
        }
        $this->buttonList->remove('reset');
        $this->buttonList->remove('back');
    }
 
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
 
    /**
     * Get form action URL.
     *
     * @return string
     */
    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }
 
        return $this->getUrl('*/*/save');
    }
}