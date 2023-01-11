<?php
namespace Core\Orm;
use Exception;

class QueryBuilder
{
	private string $query;
	private string $operation;
	private string $tableName;
	private array $fields;
	private array $orderBy;
	private array $where;

	public function __construct()
	{
		$this->query = "";
	}

	protected function setOperation(string $operation): void
	{
		$this->operation = $operation;
	}

	protected function getOperation(): string
	{
		return $this->operation;
	}

	public function setTableName(string $tableName): void
	{
		$this->tableName = $tableName;
	}

	protected function getTableName(): string
	{
		if (empty($this->tableName)) {
			throw new Exception("No table name provided");
		}

		return $this->tableName;
	}

	public function setFields(?array $fields): void
	{
		$this->fields = $fields;
	}

	protected function getFields(): string
	{
		if (empty($this->fields)) {
			return "*";
		}
		return implode(", ", $this->fields);
	}

	public function setOrderBy(?array $orderBy): void
	{
		$this->orderBy = $orderBy;
	}

	protected function getOrderBy(): string
	{
		if (empty($this->orderBy)) {
			return "";
		}
		$res = "";

		foreach ($this->orderBy as $key => $value) {
			$res .= "$key $value";
		}

		return " ORDER BY " . $res;
	}

	public function setWhere(array $where): void
	{
		$this->where = $where;
	}

	protected function getWhere(): string
	{
		if (empty($this->where)) {
			return "";
		}

		$res = "";

		foreach ($this->where as $key => $value) {
			$res .= "$value[field] $value[operator] $value[value]";
		}

		return " WHERE " . $res;
	}

	protected function setQuery(string $query): void
	{
		$this->query = $query;
	}

	protected function getQuery(): string
	{
		if (empty($this->query)) {
			throw new Exception("Query is empty");
		}

		return $this->query;
	}
}
