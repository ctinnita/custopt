<?php

class Cn_Custopt_Block_Adminhtml_Catalog_Product_CompositeConfigure
    extends Mage_Adminhtml_Block_Catalog_Product_Composite_Configure
{
    
    /**
     * Set template
     */
    protected function _construct()
    {
        $this->setTemplate('custopt/catalog/product/composite_configure.phtml');
    }
    
}