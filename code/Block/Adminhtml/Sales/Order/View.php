<?php

class Cn_Custopt_Block_Adminhtml_Sales_Order_View
    extends Mage_Adminhtml_Block_Sales_Order_View
{
    
    /**
     * Prepare form html. Add block for configurable product modification interface
     *
     * @return string
     */
    public function getFormHtml()
    {
        $html = parent::getFormHtml();
        $html .= $this->getLayout()->createBlock('custopt/adminhtml_catalog_product_compositeconfigure')->toHtml();
        return $html;
    }
        
}