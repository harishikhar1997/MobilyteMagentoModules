<?php
namespace Mobilyte\Customtheme2\Block\Adminhtml\Post\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected $_systemStore;
 
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Mobilyte\Customtheme2\Model\Status $options,
        array $data = []
    ) 
    {
        $this->_options = $options;
        
        parent::__construct($context, $registry, $formFactory, $data);
    }
 
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form', 
                            'enctype' => 'multipart/form-data', 
                            'action' => $this->getData('action'), 
                            'method' => 'post'
                        ]
            ]
        );
 
        $form->setHtmlIdPrefix('wkgrid_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Answer the query Here. '), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }
 
        $fieldset->addField(
            'product_id',
            'text',
            [
                'name' => 'product_id',
                'label' => __('Product Id'),
                'id' => 'product_id',
                'title' => __('Product Id'),
                'class' => 'required-entry',
                'required' => true,
                'readonly'=>true
                //'value'=> $model->getProductId()
            ]
        );

        $fieldset->addField(
            'customer_id',
            'text',
            [
                'name' => 'customer_id',
                'label' => __('Customer Id'),
                'id' => 'customer_id',
                'title' => __('Customer Id'),
                'placeholder'=>'0',
                'readonly'=>true
               // 'value'=> $model->getCustomerId()
            ]
        );
 
        $fieldset->addField(
            'question',
            'text',
            [
                'name' => 'question',
                'label' => __('Question'),
                'required' => true,
                'id' => 'question',
                'title' => __('Question'),
                'readonly'=>true
                //'value'=> $model->getQuestion()
                
            ]
        );

        $fieldset->addField(
            'answer',
            'text',
            [
                'name' => 'answer',
                'label' => __('Answer'),
                'required' => true,
                'id' => 'answer',
                'title' => __('Answer'),
             //   'value'=> $model->getAnswer()
                
            ]
        );

        $fieldset->addField(
            'sku',
            'text',
            [
                'name' => 'sku',
                'label' => __('SKU'),
                'required' => true,
                'id' => 'sku',
                'title' => __('SKU'),
                'readonly'=>true
                //'value'=> $model->getQuestion()
                
            ]
        );
 
        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'id' => 'status',
                'title' => __('Status'),
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );
        //print_r($model->getData());exit();
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
 
        return parent::_prepareForm();
    }
}