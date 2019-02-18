<?php

namespace Mobilyte\Myinvoice\Controller\Adminhtml\Grid;

use Magento\Store\Model\ScopeInterface;

class Sendmail extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_transportBuilder;

    protected $collection;

    protected $countFactory;

    protected $orderRepository;

    protected $temp_id;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Mobilyte\Myinvoice\Model\ResourceModel\Count\Collection $collection,
        \Mobilyte\Myinvoice\Model\CountFactory $countFactory,
        \Magento\Sales\Model\OrderRepository $orderRepository,
        \Magento\Theme\Block\Html\Header\Logo $logo,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->_storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->_messageManager = $messageManager;
        $this->collection = $collection;
        $this->countFactory = $countFactory;
        $this->orderRepository = $orderRepository;
        $this->_logo = $logo;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();
        
        $data = $this->getRequest()->getParams();
        $invoiceData = $this->orderRepository->get($data['id'])->getInvoiceCollection()->getData();
        $orderData = $this->orderRepository->get($data['id'])->getCollection()->getData();
        foreach($orderData as $order) {
            if($order['entity_id']==$data['id']) {
                $order_increment_id = $order['increment_id'];
                $order_date = $order['created_at'];
                $order_amount = $order['base_grand_total'];
                $customerEmail = $order['customer_email'];
                $customerName = $order['customer_firstname'].' '.$order['customer_lastname'];
                $store_id = $order['store_id'];
            }
        }

        $first_reminder = $this->scopeConfig->getValue(
            'sales_email/uncaptured_orders/first_reminder_template', ScopeInterface::SCOPE_STORE, $store_id
        );

        $legal_reminder = $this->scopeConfig->getValue(
            'sales_email/uncaptured_orders/legal_notice_template', ScopeInterface::SCOPE_STORE, $store_id
        );
        
        $entityIdData = $this->collection->addFieldToFilter('order_id',$data['id'])->getData();
        
        $countData = $this->countFactory->create();
        
        
        /* Receiver Detail  */
        $receiverInfo = [
            'name' => $customerName,
            'email' => 'vivek.shahi@mobilyte.com'
        ];
         
         
        /* Sender Detail  */
        $senderInfo = [
            'name' => $this->scopeConfig->getValue('trans_email/ident_sales/name',\Magento\Store\Model\ScopeInterface::SCOPE_STORE),
            'email' => $this->scopeConfig->getValue('trans_email/ident_sales/email',\Magento\Store\Model\ScopeInterface::SCOPE_STORE)
        ];

         /* Assign values for your template variables  */
        $emailTemplateVariables = array();
        $emailTemplateVariables['name'] = $customerName;
        $emailTemplateVariables['email'] = $customerEmail;
        $emailTemplateVariables['increment_id'] = $invoiceData[0]['increment_id'];
        $emailTemplateVariables['order_increment_id'] = $order_increment_id;
        $emailTemplateVariables['order_date'] = $order_date;
        $emailTemplateVariables['order_amount'] = $order_amount;
        $emailTemplateVariables['logo_url'] = $this->getLogoSrc();

        if(isset($entityIdData[0]['entity_id'])) {

            $this->temp_id = $legal_reminder;
            //$this->mailSendMethod($emailTemplateVariables,$senderInfo,$receiverInfo);
            $this->_messageManager->addSuccess("Legal Notice Sent");
            
            $count = $countData->load($entityIdData[0]['entity_id']);
            $count->setCount($count->getCount()+1);
            $count->save();

        }
        else {

            $this->temp_id = $first_reminder;
            //$this->mailSendMethod($emailTemplateVariables,$senderInfo,$receiverInfo);
            $this->_messageManager->addSuccess("Reminder Sent");

            $countData->setOrderId($data['id']);
            $countData->setCount(1);
            $countData->save();
        }
        
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }

    /**
     * [generateTemplate description]  with template file and tempaltes variables values                
     * @param  Mixed $emailTemplateVariables 
     * @param  Mixed $senderInfo             
     * @param  Mixed $receiverInfo           
     * @return void
     */
    public function generateTemplate($emailTemplateVariables,$senderInfo,$receiverInfo)
    {
        $template =  $this->_transportBuilder->setTemplateIdentifier($this->temp_id)
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_ADMINHTML, 
                        'store' => $this->_storeManager->getStore()->getId(),
                    ]
                )
                ->setTemplateVars($emailTemplateVariables)
                ->setFrom($senderInfo)
                ->addTo($receiverInfo['email'],$receiverInfo['name']);
        return $this;        
    }
 
    /**
     * [sendInvoicedOrderEmail description]                  
     * @param  Mixed $emailTemplateVariables 
     * @param  Mixed $senderInfo             
     * @param  Mixed $receiverInfo           
     * @return void
     */
    /* your send mail method*/
    public function mailSendMethod($emailTemplateVariables,$senderInfo,$receiverInfo)
    {
 
        try {
            $this->inlineTranslation->suspend();    
            $this->generateTemplate($emailTemplateVariables,$senderInfo,$receiverInfo);    
            $transport = $this->_transportBuilder->getTransport();
            $transport->sendMessage();        
            $this->inlineTranslation->resume();
        }
        catch(Exception $e) {
            $message = "Unable To send mail ".$e;
            $this->_messageManager->addError($message);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            return $resultRedirect;
        }
    }

    /**
     * Get logo image URL
     *
     * @return string
     */
    public function getLogoSrc()
    {    
        return $this->_logo->getLogoSrc();
    }
 
}

