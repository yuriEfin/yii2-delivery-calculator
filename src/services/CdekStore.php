<?php
/**
 * Created by PhpStorm.
 * User:    Евгений Емельянов <e9139905539@gmail.com>
 */

namespace uranum\delivery\services;


class CdekStore extends CdekDelivery
{
	
	/**
	 * @return int
	 */
	public function chooseTarif()
	{
		return self::TARIF_STORE_STORE;
	}
}