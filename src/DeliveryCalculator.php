<?php
/**
 * Created by PhpStorm.
 * User:    Евегний Емельянов <e9139905539@gmail.com>
 */

namespace uranum\delivery;


use uranum\delivery\services\DeliveryInterface;
use Yii;
use yii\base\Module;

class DeliveryCalculator
{
	/**
	 * @var DeliveryCargoData
	 */
	private $cargoParams;
	/**
	 * @var array
	 */
	private $servicesCollection;
	/**
	 * @var array
	 */
	private $services = [];
	
	/**
	 * DeliveryCalculator constructor.
	 *
	 * @param DeliveryCargoData $cargoParams
	 * @param  array            $services
	 */
	public function __construct($cargoParams, $services)
	{
		$this->cargoParams        = $cargoParams;
		$this->servicesCollection = $services;
	}
	
	/**
	 * Примерный результат работы метода - для передачи этих данных
	 * в представление (виджет):
	 *    $result = [
	 *        'service 1' => [
	 *            'name' => 'Post',
	 *            'terms' => '12-15',
	 *            'cost' => '340.55',
	 *            'info' => 'only landing',
	 *        ],
	 *        'service 2' => [
	 *            'name' => 'Cdek',
	 *            'terms' => '3-5',
	 *            'cost' => '240.00',
	 *            'info' => false,
	 *        ]
	 *    ];
	 * @return array $result
	 */
	public function calculate()
	{
		$this->loadServices();
		$result = [];
		/** @var DeliveryInterface $service */
		foreach ($this->services as $service) {
			$service->calculate();
			$result[] = $service->getResult();
		}
		
		return $result;
	}
	
	/**
	 * Загрузка всех служб доставки, создание их объектов
	 * и сохранение их в приватном массиве. С этим массивом
	 * работает метод calculate().
	 */
	private function loadServices()
	{
		$services = $this->servicesCollection;
		foreach ($services as $componentName => $service) {
			$class            = $service['class'];
			$this->services[] = new $class($this->cargoParams, $componentName);
		}
	}
}