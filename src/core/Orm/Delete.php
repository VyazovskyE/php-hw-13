<?php
namespace Core\Orm;
use Core\Orm\Where;

class Delete extends SQL
{
	private $where;

	public function __construct()
	{
		parent::__construct();
		$this->where = new Where();
	}

	public function where(): Where
	{
		return $this->where;
	}

	public function buildQuery(): string
	{
		$query = "DELETE FROM {$this->tableName}";
		$query .= " WHERE ";
		$query .= $this->where->getRes();
		return $query;
	}
}
