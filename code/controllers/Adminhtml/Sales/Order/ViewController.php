<?php

class Cn_Custopt_Adminhtml_Sales_Order_ViewController extends Mage_Adminhtml_Controller_Action
{
    
    public function configureItemsAction()
    {
        // Prepare data
        $configureResult = new Varien_Object();
        try {
            $itemId = (int) $this->getRequest()->getParam('id');
            if (!$itemId) {
                Mage::throwException($this->__('Item id is not received.'));
            }

            $item = Mage::getModel('sales/order_item')->load($itemId);
            if (!$item->getId()) {
                Mage::throwException($this->__('Item is not loaded.'));
            }

            $configureResult->setOk(true);

            $configureResult->setBuyRequest($item->getBuyRequest());
            $configureResult->setCurrentStoreId($item->getStoreId());
            $configureResult->setProductId($item->getProductId());
        } catch (Exception $e) {
            $configureResult->setError(true);
            $configureResult->setMessage($e->getMessage());
        }

        // Render page
        /* @var $helper Cn_Custopt_Helper_Data */
        $helper = Mage::helper('custopt/data');
        $helper->renderConfigureResult($this, $configureResult);

        return $this;
    }
    
}
