<?php
namespace Mobilyte\Myaccordion\Observer\Product;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Data implements ObserverInterface
{
	public function __construct(
		\Magento\Framework\App\RequestInterface $request,
		\Mobilyte\Myaccordion\Model\PostFactory $postFactory,
		\Mobilyte\Myaccordion\Model\ResourceModel\Post\Collection $collection
	) {
		$this->request = $request;
	    $this->postFactory = $postFactory;
	    $this->collection = $collection;
	}

	public function execute(Observer $observer)
	{
		// $post = $this->request->getPostValue();
		// echo "<pre>";print_r($post);exit;

		$post = $observer->getProduct();
  		$productId = $post->getId();
  		$data = $this->request->getPost();
  		$dataArray = get_object_vars($data);
  		//echo "<pre>";print_r($dataArray);exit;
  		$model = $this->postFactory->create();     

  		$ind1=$dataArray['product'];
  		$countData = $this->collection->addFieldToFilter('prod',$productId)->getData(); //filters the product id field
		if(isset($countData[0]['prod'])) {
		 	$model->load($countData[0]['id']);
		 	$model->setName($ind1['employee_name']);
		 	$model->setPname($ind1['product_name']);
		}
		
		else {
		 	$model->setProd($productId);
		 	$model->setName($ind1['employee_name']);
		 	$model->setPname($ind1['product_name']);
	
	    }
 
  		try{
  		$model->save();
  		}
  		 catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
         }

}
}