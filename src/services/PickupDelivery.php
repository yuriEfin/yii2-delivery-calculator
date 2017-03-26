<?php
/**
 * Created by PhpStorm.
 * User:    Евегний Емельянов <e9139905539@gmail.com>
 */

namespace uranum\delivery\services;



class PickupDelivery extends YiiModuleDelivery
{
	
	public function calculate()
	{
		$this->name       = $this->serviceParams->name;
		$this->info       = $this->serviceParams->info ? : '';
		$this->resultCost = $this->serviceParams->fixedCost ? : 0;
		$this->terms      = false;
	}
	
}