<?php
 
class Magentix_Brochure_Helper_Data extends Mage_Core_Helper_Abstract {
    public function getUserName() {
        if (!Mage::getSingleton('customer/session')->isLoggedIn()) return '';
 
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        return trim($customer->getLastname());
    }
}