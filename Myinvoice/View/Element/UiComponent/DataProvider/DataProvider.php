<?php
namespace Mobilyte\Myinvoice\View\Element\UiComponent\DataProvider;
 
use Mobilyte\Myinvoice\Model\ResourceModel\Grid\CollectionFactory;
 
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
 
    public function __construct(
        CollectionFactory $collectionFactory,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        $collection = $collectionFactory->create();
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
        $this->collection = $collectionFactory->create()
                          ->addFieldToFilter('state', 1);
    }
}