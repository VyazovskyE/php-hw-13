<?php
namespace App\Models;
use Core\Orm\Select;

class Employees
{
	public function getEmployees(): array
	{
		$select = new Select();
		$select->setTableName("employees");
		$employees = $select->execute();

		$select->setFields(["COUNT(*) AS total"]);
		$select->setLimit(0);
		$select->setOffset(0);
		$total = $select->execute();
		return [
			"total" => $total[0]["total"],
			"list" => $employees
		];
	}

	public function getJobTitles(): array
	{
		$select = new Select();
		$select->setTableName("employees");
		$select->setFields(["jobTitle, COUNT(*)"]);
		$select->setGroupBy(["jobTitle"]);
		$jobTitles = $select->execute();

		return [
			"total" => count($jobTitles),
			"list" => $jobTitles
		];
	}
}
