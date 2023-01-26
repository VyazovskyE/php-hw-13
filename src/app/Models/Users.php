<?php
namespace App\Models;

use Core\Orm\Delete;
use Core\Orm\Insert;
use Core\Orm\Select;
use Core\Orm\Update;
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
		$select->setOrderBy(['registered_at' => 'DESC']);
		$select->execute();
		$users = $select->fetch();
		return $users;
	}

	public function getUser(string $id): ?array
	{
		$select = new Select();
		$select->setTableName('users');
		$select->where()
			->condition('id', '=', $id);
		$select->execute();
		$result = $select->fetch();

		if (count($result) === 0) {
			return null;
		}

		return $result[0];
	}

	public function updateUser(array $data): void
	{
		$update = new Update();
		$update->setTableName('users');
		$update->setData([
			'name' => $data['name'],
			'email' => $data['email'],
			'age' => $data['age'],
		]);
		$update->where()
			->condition('id', '=', $data['id']);
		$update->execute();
	}

	public function deleteUser(string $id): void
	{
		$delete = new Delete();
		$delete->setTableName('users');
		$delete->where()
			->condition('id', '=', $id);
		$delete->execute();
	}
}
