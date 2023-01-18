<?php

namespace App\Models;

use Core\Orm\Insert;
use Core\Orm\Select;

class Customers
{
	public function getCustomers(): array
	{
		$select = new Select();
		$select->setTableName("customers");
		$select->setOrderBy(["customerNumber" => "ASC"]);
		$select->setLimit(10);
		$select->setOffset(5);
		$customers = $select->execute();


		$select->setFields(["COUNT(*) AS total"]);
		$select->setLimit(0);
		$select->setOffset(0);
		$total = $select->execute();
		return [
			"total" => $total[0]["total"],
			"list" => $customers
		];
	}

	public function addCustomer(array $data): void
	{
		$insert = new Insert();
		$insert->setTableName("customers");
		$insert->setData($data);
		$insert->execute();
	}
}
