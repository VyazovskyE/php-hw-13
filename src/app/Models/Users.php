<?php
namespace App\Models;

use Core\Orm\Insert;
use Core\Orm\Select;
use Core\Orm\Where;
class Users
{
	public function createUser(array $data): void
	{
		$insert = new Insert();
		$insert->setTableName('users');
		$insert->setData($data);
		$insert->execute();
	}

	public function getUsers(array $filter): array
	{
		$select = new Select();
		$select->setTableName('users');
		$select->where()
			->condition('age', 'BETWEEN', [$filter['ageFrom'], $filter['ageTo']]);
		$select->execute();
		$users = $select->fetch();
		return $users;
	}
}
