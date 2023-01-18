<?php
namespace Core\Orm;

use PDO;

class Insert
{
	private PDO $connector;
	private string $tableName;
	private array $data;

	public function __construct()
	{
		$connector = new DBConnector();
		$this->connector = $connector->connect();
	}

	public function execute()
	{
		$query = $this->buildQuery();
		$statement = $this->connector->prepare($query);
		$statement->execute();
	}

	public function buildQuery()
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

	public function setTableName(string $tableName): void
	{
		$this->tableName = $tableName;
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
