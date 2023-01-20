<?php
namespace App\Controllers;
use App\Models\Users as UsersModel;
use Core\Renderer;

class Users
{
	public function createUser(): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->createUserPage();
		} else {
			$this->createUserRequest();
		}
	}

	public function createUserPage(bool $success = false, array $errors = []): void
	{
		Renderer::render('createUser', 'Create User', [
			'success' => $success,
			'errors' => $errors,
		]);
	}

	public function createUserRequest(): void
	{
		$keys = ['name', 'email', 'age'];

		$data = [];
		foreach ($keys as $key) {
			$data[$key] = $_POST[$key];
		}

		$errors = [];
		foreach ($data as $key => $value) {
			if (empty($value)) {
				$errors[] = "The field $key is required";
			}
		}

		if (count($errors) > 0) {
			$this->createUserPage(false, $errors);
			return;
		}

		try {
			$model = new UsersModel();
			$model->createUser($data);
			$this->createUserPage(true);
		} catch (\Exception $e) {
			$this->createUserPage(false, [$e->getMessage()]);
		}
	}

	public function userList(): void
	{
		$ageFrom = $_GET['age_from'] ?? 0;
		$ageTo = $_GET['age_to'] ?? 100;

		$model = new UsersModel();
		$users = $model->getUsers([
			'ageFrom' => $ageFrom,
			'ageTo' => $ageTo,
		]);

		Renderer::render('usersList', 'Users', [
			'users' => $users,
			'ageFrom' => $ageFrom,
			'ageTo' => $ageTo,
		]);
	}
}
