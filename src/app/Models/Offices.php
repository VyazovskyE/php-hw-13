<?php
namespace App\Models;

use Core\Orm\Select;

class Offices
{
	public function getOffices(): array
	{
		$select = new Select();
		$select->setTableName("offices");
		$offices = $select->execute();

		$select->setFields(["COUNT(*) AS total"]);
		$select->setLimit(0);
		$select->setOffset(0);
		$total = $select->execute();
		return [
			"total" => $total[0]["total"],
			"list" => $offices
		];
	}
}
