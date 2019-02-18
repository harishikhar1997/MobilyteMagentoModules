<?php

namespace Mobilyte\ImageGallery\Block\Adminhtml\Gallery\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;

class Info extends Generic implements TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;


   /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param array $data
     */

    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form fields
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {
      
        $model = $this->_coreRegistry->registry('imagegallery_gallery');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('gallery_');
        $form->setFieldNameSuffix('gallery');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('User Information')]
        );

        if ($model->getPostId()) {
            $fieldset->addField(
                'id',
                'hidden',

                ['name' => 'id',
                'value' =>$model->getPostId()
            ]
            );
        }
        $fieldset->addField(
            'name',
            'text',
            [
                'name'        => 'name',
                'label'    => __('Name'),
                'required'     => true,
                'value'=> $model->getName()
            ]
        );

        $fieldset->addField(
            'featured_image',
            'image',
            [
                'label' => __('Image'),
                'name' => 'featured_image',
                'required'  =>true,
                'note' => 'Allow image type: jpg, jpeg, gif, png',
                'value' =>$model->getFeaturedImage()
            ]
        );


        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'post_description',
            'editor',
            [
                'name'        => 'post_description',
                'label'    => __('Description'),
                'required'     => true,
                'config'    => $wysiwygConfig,
                 'value'=> $model->getPostDescription()
            ]
        );

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('News Info');
    }
 
    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('News Info');
    }
 
    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }
 
    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}