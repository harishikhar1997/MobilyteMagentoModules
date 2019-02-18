<?php
namespace Mobilyte\ImageGallery\Controller\Index;

class Products extends \Magento\Framework\App\Action\Action
{
	public function __construct(
  		\Magento\Framework\App\Action\Context $context,
 		// \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory,
  		\Magento\Catalog\Model\ProductFactory $productFactory,
  		\Magento\Catalog\Model\Product\OptionFactory $customOption
  	)
	{
		// $this->productRepository=$productRepository;
		$this->productFactory=$productFactory;
		$this->customOption=$customOption;
		parent::__construct($context);
	}

	public function execute()
	{
		try{
			$product=$this->productFactory->create();
			$product->setName('test-Product');
			$product->setSku('test-sku');
			$product->setDescription('test product Description');
			$product->setShortDescription('test product short Description');
			$product->setWebsiteIds([1]);
			$product->setUrlKey('fght-ghyst');
			$product->setSku('test-sku');
			$product->setAttributeSetId(4);
			$product->setPrice("$500");
			$product->setVisibility(4);
			$product->setStockData(array(
			'use_config_manage_stock' => 0,
                                'manage_stock' => 1,
                                'min_sale_qty' => 1,
            					'max_sale_qty' => 2,
                                'is_in_stock' => 1,
                                'qty' => 100));

			//$product = $this->productRepository->save($product);

			$product->save();


			$options=array(
				array(
					"sort_order"=>1,
					"title"=>"Custom Option 1",
					"price_type"=>"fixed",
					"price"=>"10",
					"type"=>"field",
					"is_require"=>0
				),
				array(
					"sort_order"=>2,
					"title"=>"Custom Option 2",
					"price_type"=>"fixed",
					"price"=>"20",
					"type"=>"field",
					"is_require"=>0
				)

			);

			foreach($options as $arrayOption){
				 $product->setHasOptions(1);
        		 $product->getResource()->save($product);
        		 
        		 $option=$this->customOption->create();
        		 $option->setProductId($product->getId());
        		 $option->setStoreId($product->getStoreId());
        		 $option->addData($arrayOption);
        		 $option->save();
        		 $product->addOption($option); 

			}
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}
}