define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'testpayment', //  protected $_code = 'testpayment' =>is defined in PaymentMethod.php
                component: 'Mobilyte_ImageGallery/js/view/payment/method-renderer/testpayment'
            }
        );
        return Component.extend({});
    }
);