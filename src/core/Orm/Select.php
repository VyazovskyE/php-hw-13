<?php
namespace Core\Orm;
use PDO;
use Exception;

class Select extends SQL
{
	private array $fields;
	private array $orderBy;
	private Where $where;
	private int $limit = 0;
	private int $offset = 0;
	private array $groupBy = [];
	private array $joinConfig = [];

	protected function buildQuery(): string
	{
		$query = "SELECT ";
		$query .= $this->getFields();
		$query .= " FROM ";
		$query .= $this->tableName;
		$query .= $this->getJoinConfigString();
		$query .= $this->getGroupBy();
		$query .= $this->getOrderBy();
		$query .= $this->getWhere();
		$query .= $this->getLimitString();
		return $query;
	}

	public function setFields(?array $fields): void
	{
		$this->fields = $fields;
	}

	private function getFields(): string
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

	private function getOrderBy(): string
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

	public function where(): Where
	{
		$this->where = new Where();
		return $this->where;
	}

	private function getWhere(): string
	{
		$whereString = $this->where->getRes();
		if (empty($whereString)) {
			return "";
		}

		return " WHERE " . $whereString;
	}

	public function setLimit(int $limit): void
	{
		$this->limit = $limit;
	}

	public function setOffset(int $offset): void
	{
		$this->offset = $offset;
	}

	private function getLimitString(): string
	{
		if ($this->limit === 0) {
			return "";
		}

		if ($this->offset === 0) {
			return " LIMIT " . $this->limit;
		}

		return " LIMIT " . $this->offset . ", " . $this->limit;
	}

	public function setGroupBy(array $groupBy): void
	{
		$this->groupBy = $groupBy;
	}

	private function getGroupBy(): string
	{
		if (empty($this->groupBy)) {
			return "";
		}

		return " GROUP BY " . implode(", ", $this->groupBy);
	}

	public function setJoinConfig(array $joinConfig): void
	{
		$this->joinConfig = $joinConfig;
	}

	private function getJoinConfigString(): string
	{
		if (empty($this->joinConfig)) {
			return "";
		}

		$res = "";

		foreach ($this->joinConfig as $value) {
			$alias = isset($value['tableAlias']) ? " AS $value[tableAlias]" : "";
			$res .= " $value[type] JOIN $value[table] $alias ON $value[on]";
		}

		return $res;
	}

	public function fetch(): array
	{
		return $this->statement->fetchAll(PDO::FETCH_ASSOC);
	}
}
