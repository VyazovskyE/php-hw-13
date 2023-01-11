<?php

namespace App\Models;
use Core\Orm\Select;

class Customers
{
	public function getCustomers(): array
	{
		$select = new Select();
		$select->setTableName("customers");
		$customers = $select->execute();
		$select->setFields(["COUNT(*) AS total"]);
		$total = $select->execute();
		return [
			"total" => $total[0]["total"],
			"list" => $customers
		];
	}
}
