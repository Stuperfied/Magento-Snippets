<?php
/*<!-- 
// This code is called by app/design/frontend/tt/theme165/template/catalog/product/mostviewed.phtml
// It is used to display the most viewed and best selling products on the home page.
-->*/
class Mage_Catalog_Block_Product_Mostviewed extends Mage_Catalog_Block_Product_Abstract{
    public function __construct(){
        parent::__construct();
        $storeId = Mage::app()->getStore()->getId();
        $products = Mage::getResourceModel('reports/product_collection')
            ->addOrderedQty()
            ->addAttributeToSelect('*')
            ->addAttributeToSelect(array('name', 'price', 'small_image'))
            ->setStoreId($storeId)
            ->addStoreFilter($storeId)
            ->addViewsCount();
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
 
        $products->setPageSize(6)->setCurPage(1);
        
        $bstoreId = Mage::app()->getStore()->getId();
        $bproducts = Mage::getResourceModel('reports/product_collection')
            ->addOrderedQty()
            ->addAttributeToSelect('*')
            ->addAttributeToSelect(array('name', 'price', 'small_image'))
            ->setStoreId($bstoreId)
            ->addStoreFilter($bstoreId)
            ->setOrder('ordered_qty', 'desc'); // most best sellers on top
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($bproducts);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($bproducts);
 
        $bproducts->setPageSize(6)->setCurPage(1);

        $this->setProductCollection($products);
        $this->setProductCollection2($bproducts);

    }
}
?>