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
		# (first_name = 'Vasi' AND last_name = 'Pupkin') OR (first_name='Petya' AND second_name = 'Sidorov' AND people_color = 'blue')
		/* $where = new Where();
		$where
			->group(function ($where) {
				$where->condition('first_name', '=', "Vasi");
				$where->and();
				$where->condition('last_name', '=', "Pupkin");
			})
			->or()
			->group(function ($where) {
				$where->condition('first_name', '=', "Petya");
				$where->and();
				$where->condition('second_name', '=', "Sidorov");
				$where->and();
				$where->condition('people_color', '=', "blue");
			});

		print_r($where->getRes()); */


		$select = new Select();
		$select->setTableName('users');
		$select->where()
			->condition('age', 'BETWEEN', [$filter['ageFrom'], $filter['ageTo']]);
		$select->execute();
		$users = $select->fetch();
		return $users;
	}
}
