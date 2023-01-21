<?php
namespace Core\Orm;

use Exception;

class Where
{
	private string $res = "";

	public function condition(string $field, string $operator, string|array $value): self
	{
		$formattedValue = $this->formatValue($operator, $value);
		
		$this->res .= "`$field` $operator $formattedValue";
		return $this;
	}

	private function formatValue(string $operator, string|array $value): string
	{
		$formattedValue = "";
	
		if (is_array($value)) {
			if (empty($value)) {
				throw new Exception("Value can't be empty");
			}

			if ($operator === 'BETWEEN') {
				$formattedValue = "'$value[0]' AND '$value[1]'";
			} else {
				$formattedValue = "('" . implode("', '", $value) . "')";
			}
		} else {
			$formattedValue = "'$value'";
		}
		
		return $formattedValue;
	}

	public function and(): self
	{
		$this->res .= ' AND ';
		return $this;
	}

	public function or(): self
	{
		$this->res .= " OR ";
		return $this;
	}

	public function group(callable $callback): self
	{
		$group = "( ";
		$where = new Where();
		$callback($where);
		$group .= $where->getRes();
		$group .= " )";
		$this->res .= $group;
		return $this;
	}

	public function getRes(): string
	{
		return $this->res;
	}
}
