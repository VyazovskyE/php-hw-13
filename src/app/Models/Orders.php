<?php
namespace App\Models;
use Core\Orm\Select;

class Orders
{
	public function getOrders(): ?array
	{
		$select = new Select();
		$select->setTableName("orders");
		$select->setLimit(10);
		$select->setJoinConfig([
			[
				"type" => "LEFT",
				"table" => "orderdetails",
				"on" => "orders.orderNumber = orderdetails.orderNumber"
			]
		]);

		$data = $select->execute();
		return [
			"total" => count($data),
			"list" => $data,
		];
	}
}
