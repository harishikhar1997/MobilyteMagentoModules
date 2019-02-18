<?php

namespace Mobilyte\Myinvoice\Ui\Component\Listing\Grid\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Mobilyte\Myinvoice\Model\ResourceModel\Count\Collection;

class Count extends Column
{
    protected $countCollection;
    /**
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [],
        Collection $countCollection
    ) {
        $this->countCollection = $countCollection;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {
            $data = $this->countCollection;
            foreach ($dataSource['data']['items'] as &$item) {
                $updateData = clone $data;
                if (isset($item['order_id'])) {
                    $countData = $updateData->addFieldToFilter('order_id',$item['order_id'])->getData();
                    if(isset($countData[0]['order_id']) && ($item['order_id']==$countData[0]['order_id'])) {
                        $count = $countData[0]['count'];
                    }
                    else {
                        $count = 0;
                    }
                    $item['count'] = $count;

                }
            }
        }
        return $dataSource;
    }
}
