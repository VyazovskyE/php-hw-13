<?php
namespace App\Models;

use Core\Orm\Insert;
use Core\Orm\Select;

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
		$select->setWhere([
			[
				'field' => 'age',
				'operator' => '>=',
				'value' => $filter['ageFrom'],
			],
			[
				'field' => 'age',
				'operator' => '<=',
				'value' => $filter['ageTo'],
			]
		]);
		$select->execute();
		$users = $select->fetch();
		return $users;
	}
}
