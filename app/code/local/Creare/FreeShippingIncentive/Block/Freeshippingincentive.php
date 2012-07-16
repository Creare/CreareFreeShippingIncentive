<?php

class Creare_FreeShippingIncentive_Block_FreeShippingIncentive extends Mage_Checkout_Block_Cart_Abstract
{
	public function isFreeShippingEnabled()
	{			
		$active = Mage::getStoreConfig("carriers/freeshipping/active");
		$amount = Mage::getStoreConfig("carriers/freeshipping/free_shipping_subtotal");	
	
		if(!$active || $amount <= 0){
			return false;
		} else {
			return true;	
		}
	}

	public function getRemainingAmount()
	{
		$symbol = Mage::app()->getLocale()->currency(Mage::app()->getStore()->
     getCurrentCurrencyCode())->getSymbol();	 
	 	$total = Mage::getSingleton('checkout/cart')->getQuote()->getSubtotal();	
		$minimum = Mage::getStoreConfig("carriers/freeshipping/free_shipping_subtotal");
		
		$value = $minimum-$total;
		
		if($value < 0){
			return false;	
		} else {	 
			return $symbol.number_format($value,2);
		}
	}
	
	public function getMinimumValue()
	{
		$symbol = Mage::app()->getLocale()->currency(Mage::app()->getStore()->
     getCurrentCurrencyCode())->getSymbol();		
		$minimum = Mage::getStoreConfig("carriers/freeshipping/free_shipping_subtotal");
		
		return $symbol.number_format($minimum, 2);	
		
	}
	
}