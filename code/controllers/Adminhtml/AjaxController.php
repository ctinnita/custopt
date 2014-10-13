<?php

class Cn_Custopt_Adminhtml_AjaxController extends Mage_Adminhtml_Controller_Action 
{
    
    public function saveAction()
    {
        $itemId = $this->getRequest()->get('id');
        $requestOptions = $this->getRequest()->get('options');
        
        $item = Mage::getModel('sales/order_item');        
        $item->load($itemId);                

        $oldOptions = $item->getProductOptions();
        //Mage::log("old options:\n" . print_r($oldOptions, true));
        
        $product = $item->getProduct();
        $options = $product->getOptions();
        
        $oldOptions['info_buyRequest']['options'] = $requestOptions;
        $buyRequest = new Varien_Object($oldOptions['info_buyRequest']);        
        
        foreach ($options as $option) {
            $optionId = $option->getId();
            if (array_key_exists($optionId, $requestOptions)) {

                $group = $option->groupFactory($option->getType())
                    ->setOption($option)
                    ->setProduct($product)
                    ->setRequest($buyRequest)
                    ->validateUserValue($buyRequest->getOptions());                
                
                $preparedValue = $group->prepareForCart();                
                
                $newCustomOptions[] = array(
                    'label' => $option->getTitle(),
                    'value' => $group->getFormattedOptionValue($preparedValue),
                    'print_value' => $group->getPrintableOptionValue($preparedValue),
                    'option_id' => $option->getId(),
                    'option_type' => $option->getType(),
                    'option_value' => $preparedValue,
                    'custom_view' => $group->isCustomizedView()
                );
            }
        } //for
        
        $newOptions['info_buyRequest'] = $oldOptions['info_buyRequest'];
        $newOptions['options'] = $newCustomOptions;
        
        $item->setProductOptions($newOptions);
        $item->save();
    }
    
    public function reloadItemAction() 
    {        
        $itemId = (int) $this->getRequest()->getParam('id');
        if (!$itemId) {
            Mage::throwException($this->__('Item id is not received.'));
        }

        $item = Mage::getModel('sales/order_item')->load($itemId);
        if (!$item->getId()) {
            Mage::throwException($this->__('Item is not loaded.'));
        }        
        
        $this->loadLayout();   
        $this->getLayout()->getBlock('root')->setData('item', $item);        
        $this->renderLayout();        
    }
    
}