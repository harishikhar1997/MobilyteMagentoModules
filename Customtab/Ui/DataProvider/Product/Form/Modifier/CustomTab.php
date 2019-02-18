<?php
namespace Mobilyte\Customtab\Ui\DataProvider\Product\Form\Modifier;
 
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\Form\Fieldset;
use Mobilyte\Customtab\Model\CustomtabFactory;
 
class CustomTab extends AbstractModifier
{
 
    const SAMPLE_FIELDSET_NAME = 'custom_fieldset';
    const SAMPLE_FIELD_NAME = 'is_custom';
 
     
    protected $_backendUrl;
    protected $_productloader;
    protected $_modelCustomtabFactory;
     
    /**
     * @var \Magento\Catalog\Model\Locator\LocatorInterface
     */
    protected $locator;
 
    /**
     * @var ArrayManager
     */
    protected $arrayManager;
 
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
 
    /**
     * @var array
     */
    protected $meta = [];
 
    /**
     * @param LocatorInterface $locator
     * @param ArrayManager $arrayManager
     * @param UrlInterface $urlBuilder
     */
    public function __construct(
        LocatorInterface $locator,
        ArrayManager $arrayManager,
        UrlInterface $urlBuilder,
        CustomtabFactory $modelFriendFactory,
        \Magento\Catalog\Model\ProductFactory $_productloader,
        \Magento\Backend\Model\UrlInterface $backendUrl
    ) {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
        $this->urlBuilder = $urlBuilder;
        $this->_modelCustomtabFactory = $modelFriendFactory;
        $this->_productloader = $_productloader;
        $this->_backendUrl = $backendUrl;
    }
 
    public function modifyData(array $data)
    {
        return $data;
    }
 
    public function modifyMeta(array $meta)
    {
        $this->meta = $meta;
        $this->addCustomTab();
 
        return $this->meta;
    }
 
    protected function addCustomTab()
    {
        $this->meta = array_merge_recursive(
            $this->meta,
            [
                static::SAMPLE_FIELDSET_NAME => $this->getTabConfig(),
            ]
        );
    }
 
    protected function getTabConfig()
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Custom Tab'),
                        'componentType' => Fieldset::NAME,
                        'dataScope' => '',
                        'provider' => static::FORM_NAME . '.product_form_data_source',
                        'ns' => static::FORM_NAME,
                        'collapsible' => true,
                    ],
                ],
            ],
            'children' => [
                static::SAMPLE_FIELD_NAME => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => ('My Tab'),
                                'formElement' => \Magento\Ui\Component\Form\Element\Select::NAME,
                                'componentType' => \Magento\Ui\Component\Form\Field::NAME,
                                'dataScope' => static::SAMPLE_FIELD_NAME,
                                'options' => $this->getCustomtaboption(),
                                'value' => $this->getCustomtabSelectedOptions(),
                                'dataType' => \Magento\Ui\Component\Form\Element\DataType\Number::NAME,
                                'sortOrder' => 10,
                                'required' => true,
                            ],
                        ],
                    ],
                    'children' => [],
                ],
            ],
        ];
    }
     
    protected function getCustomtaboption() {
        $getChooseOptions = [];
        $getChooseOptions[] = [
            'label' => 'Choose Options',
            'value' => '-1',
        ];
        $getChooseOptions[] = [
            'label' => 'Yes',
            'value' => '1',
        ];
        $getChooseOptions[] = [
            'label' => 'No',
            'value' => '2',
        ];
        return $getChooseOptions;
    }
     
     
    protected function getCustomtabSelectedOptions() {
         
         
        $currentproduct = $this->locator->getProduct()->getId();
        $CustomtabModel = $this->_modelCustomtabFactory->create();
        $CustomtabModel->load($currentproduct, 'product_id');
        if($CustomtabModel->getId())
         return 1;
        else
         return 2;
         
         
    }
}