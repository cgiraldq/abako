<?php

class Inchoo_Shipping_Model_Carrier
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    /**
     * Carrier's code, as defined in parent class
     *
     * @var string
     */
    protected $_code = 'inchoo_shipping';

    /**
     * Returns available shipping rates for Inchoo Shipping carrier
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        /** @var Mage_Shipping_Model_Rate_Result $result */
        $result = Mage::getModel('shipping/rate_result');

        /** @var Inchoo_Shipping_Helper_Data $expressMaxProducts */
        $expressMaxWeight = Mage::helper('inchoo_shipping')->getExpressMaxWeight();

        $expressAvailable = true;
        foreach ($request->getAllItems() as $item) {
            if ($item->getWeight() > $expressMaxWeight) {
                $expressAvailable = false;
            }
        }
      
      
        $result->append($this->_getDomicilioRate(0));
      
        $arr = $this->getAllowedMethods();
      foreach ($arr as &$valor) {
         $result->append($this->_getAnyRate($valor,0));
      }
      
      
/*
        if ($expressAvailable) {
            $result->append($this->_getExpressRate());
        }
        $result->append($this->_getStandardRate());
      */
        

        return $result;
    }

    /**
     * Returns Allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return array(/*
            'standard'    =>  'Standard delivery',
            'express'     =>  'Express delivery',*/
            'Servientrega'    =>  'Servientrega',
            'Saferbo'     =>  'Saferbo',
            'Redetrans'    =>  'Redetrans',
            'Envía'     =>  'Envía',
            'Interrapidisimo'     =>  'Interrapidisimo',
        );
    }
    protected function _getAnyRate($couriername, $price)
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $rate */
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod($couriername);
        $rate->setMethodTitle($couriername);
        $rate->setPrice($price);
        $rate->setCost(0);

        return $rate;
    }

    /**
     * Get Standard rate object
     *
     * @return Mage_Shipping_Model_Rate_Result_Method
     */
    protected function _getStandardRate()
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $rate */
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('large');
        $rate->setMethodTitle('Standard delivery');
        $rate->setPrice(1.23);
        $rate->setCost(0);

        return $rate;
    }

    /**
     * Get Express rate object
     *
     * @return Mage_Shipping_Model_Rate_Result_Method
     */
    protected function _getExpressRate()
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $rate */
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('express');
        $rate->setMethodTitle('Express delivery');
        $rate->setPrice(12.3);
        $rate->setCost(0);

        return $rate;
    }
  
    protected function _getDomicilioRate($price)
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $rate */
        $rate = Mage::getModel('shipping/rate_result_method');

        $rate->setCarrier($this->_code);
        $rate->setCarrierTitle($this->getConfigData('title'));
        $rate->setMethod('!Domicilio');
        $rate->setMethodTitle('Domicilio en el área metropolitana de Medellín');
        $rate->setPrice($price);
        $rate->setCost(0);

        return $rate;
    }
}