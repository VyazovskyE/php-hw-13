<?php
namespace Core\Orm;

use PDO;

class Insert extends SQL
{
	private array $data;

	public function buildQuery(): string
	{
		$fields = $this->getFields();
		$values = $this->getValues();
		$query = "INSERT INTO {$this->tableName} (";
		$query .= implode(', ', $fields);
		$query .= ") VALUES (";
		$query .= "'" . implode("', '", $values) . "'";
		$query .= ")";
		return $query;
	}

	public function setData(array $data): void
	{
		$this->data = $data;
	}

	private function getFields()
	{
		return array_keys($this->data);
	}

	private function getValues()
	{
		return array_values($this->data);
	}
}
