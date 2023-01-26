<?php
namespace Core\Orm;

class Update extends SQL
{
	private array $data;
	private Where $where;

	public function buildQuery(): string
	{
		$fields = $this->getFields();
		$query = "UPDATE {$this->tableName} SET ";
		$query .= implode(', ', $fields);
		$query .= $this->getWhere();
		return $query;
	}

	public function setData(array $data)
	{
		$this->data = $data;
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

	private function getFields()
	{
		$fields = [];
		foreach ($this->data as $key => $value) {
			$fields[] = "$key = '$value'";
		}
		return $fields;
	}
}
