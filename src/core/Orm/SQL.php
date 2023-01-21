<?php
namespace Core\Orm;

use PDO;
use PDOStatement;

abstract class SQL
{
	protected string $tableName;
	protected PDO $connector;
	protected PDOStatement $statement;

	public function __construct()
	{
		$connector = new DBConnector();
		$this->connector = $connector->connect();
	}

	abstract protected function buildQuery(): string;
	public function execute(): void
	{
		$query = $this->buildQuery();
		$statement = $this->connector->prepare($query);
		$statement->execute();
		$this->statement = $statement;
	}

	public function setTableName(string $tableName): void
	{
		$this->tableName = $tableName;
	}
}
