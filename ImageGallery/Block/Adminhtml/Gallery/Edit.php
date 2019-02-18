<?php

namespace Mobilyte\ImageGallery\Block\Adminhtml\Gallery;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class Edit extends Container
{
   /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'post_id';
        $this->_controller = 'adminhtml_gallery';
        $this->_blockGroup = 'Mobilyte_ImageGallery';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save'));
        $this->buttonList->add(
            'saveandcontinue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );

        $model = $this->_coreRegistry->registry('imagegallery_gallery');
        $deleteId = $model->getPostId();
        $this->buttonList->add(
        'delete',
            array(
                'label' => __('Delete'),
                'class' => 'delete',
                'data_attribute' => array(
                    'mage-init' => array('button' => array('event' => 'delete', 'target' => '#edit_form'))   
                ),
                'onclick' => 'setLocation("'.$this->getUrl('mobilyte_imagegallery/post/delete',array('_query' => array('deleteid' => $deleteId))).'")'
            ),
            -100
        );
         $this->buttonList->remove('reset');
    }

    /**
     * 
     * @return string
     */
    public function getHeaderText()
    {
        $newsRegistry = $this->_coreRegistry->registry('mobilyte_gallery');
        if ($newsRegistry->getId()) {
            $newsTitle = $this->escapeHtml($newsRegistry->getTitle());
            return __("Edit News '%1'", $newsTitle);
        } else {
            return __('Add News');
        }
    }
 
    /**
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('post_body') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'post_body');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'post_body');
                }
            };
        ";

        return parent::_prepareLayout();
    }
}