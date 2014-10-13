<?php

class Cn_Custopt_Helper_Data extends Mage_Adminhtml_Helper_Catalog_Product_Composite
{
    
     /**
     * Init composite product configuration layout
     *
     * $isOk - true or false, whether action was completed nicely or with some error
     * If $isOk is FALSE (some error during configuration), so $productType must be null
     *
     * @param Mage_Adminhtml_Controller_Action $controller
     * @param bool $isOk
     * @param string $productType
     * @return Mage_Adminhtml_Helper_Catalog_Product_Composite
     */
    protected function _initConfigureResultLayout($controller, $isOk, $productType)
    {
        $update = $controller->getLayout()->getUpdate();
        if ($isOk) {
            $update->addHandle('CUSTOPT_ADMINHTML_CATALOG_PRODUCT_COMPOSITE_CONFIGURE')
                ->addHandle('PRODUCT_TYPE_' . $productType);
        } else {
            $update->addHandle('ADMINHTML_CATALOG_PRODUCT_COMPOSITE_CONFIGURE_ERROR');
        }
        $controller->loadLayoutUpdates()->generateLayoutXml()->generateLayoutBlocks();
        return $this;
    }
    
}  