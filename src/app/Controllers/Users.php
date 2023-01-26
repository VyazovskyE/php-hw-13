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

	public function userList(array $messages = []): void
	{
		$_SESSION['test'] = 'test';
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
			'messages' => $messages,
		]);
	}

	public function userPage(?string $id = null, bool $success = false, array $errors = []): void
	{
		$currentId = $id ? $id : $_GET['id'];

		$model = new UsersModel();
		$user = $model->getUser($currentId);
		if ($user === null) {
			$error404 = new Error404();
			$error404->index();
			return;
		}
		Renderer::render('userPage', "User: $user[name]", [
			'user' => $user,
			'success' => $success,
			'errors' => $errors,
		]);
	}

	public function updateUser(): void
	{
		$keys = ['id', 'name', 'email', 'age'];

		$data = [];
		foreach ($keys as $key) {
			$data[$key] = $_POST[$key];
		}

		$errors = [];
		foreach ($data as $key => $value) {
			if (empty($value)) {
				$errors[] = "The field \"$key\" is required";
			}
		}

		$id = $data['id'];

		if (count($errors) > 0) {
			$this->userPage($id, false, $errors);
			return;
		}

		try {
			$model = new UsersModel();
			$model->updateUser($data);
			$this->userPage($id, true);
		} catch (\Exception $e) {
			$this->userPage($id, false, [$e->getMessage()]);
		}
	}

	public function deleteUser(?string $id = null): void
	{
		$currentId = $id ? $id : $_GET['id'];

		try {
			$model = new UsersModel();
			$model->deleteUser($currentId);
			Renderer::render('userDeleted', 'User deleted');
		} catch (\Exception $e) {
			$this->userList([
				[
					'type' => 'danger',
					'message' => $e->getMessage(),
				]
			]);
		}
	}
}
