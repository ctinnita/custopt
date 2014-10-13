<?php

class Cn_Custopt_Block_Adminhtml_Sales_Order_View_ItemsRendererDefault
    extends Mage_Adminhtml_Block_Sales_Order_View_Items_Renderer_Default
{
    
    /**
     * Return html button which calls configure window
     *
     * @param  Mage_Sales_Model_Quote_Item $item
     * @return string
     */
    public function getConfigureButtonHtml($item)
    {
        $product = $item->getProduct();

        $options = array('label' => Mage::helper('sales')->__('Configure'));
        if ($product->canConfigure()) {
            $options['onclick'] = sprintf('productConfigure.showItemConfiguration(\'items\', %s)', $item->getId());
        } else {
            $options['class'] = ' disabled';
            $options['title'] = Mage::helper('sales')->__('This product does not have any configurable options');
        }

        return $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData($options)
            ->toHtml();
    }
        
}