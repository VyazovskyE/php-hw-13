<?php
namespace App\Controllers;
use App\Models\Employees as EmployeesModel;
use App\Models\Offices as OfficesModel;
use Core\APIRenderer;
use Core\Renderer;

class Employees
{
	public function get(): void
	{
		$model = new EmployeesModel();
		$data = $model->getEmployees();
		Renderer::render('employees', 'Employees', [
			"employees" => $data["list"],
		]);
	}

	public function getJobTitles(): void
	{
		$model = new EmployeesModel();
		$data = $model->getJobTitles();
		APIRenderer::renderList($data);
	}

	public function addEmployee(): void
	{
		if ($_SERVER["REQUEST_METHOD"] === "GET") {
			$this->addEmployeePage();
		} else {
			$this->addEmployeeRequest();
		}
	}

	public function addEmployeePage(bool $success = false, array $errors = []): void
	{
		$employeesModel = new EmployeesModel();
		$employees = $employeesModel->getEmployees();
		$officesModel = new OfficesModel();
		$offices = $officesModel->getOffices();
		Renderer::render('addEmployee', 'Add Employee', [
			"employees" => $employees["list"],
			"offices" => $offices["list"],
			"success" => $success,
			"errors" => $errors,
		]);
	}

	public function addEmployeeRequest(): void
	{
		$keys = ["employeeNumber", "lastName", "firstName", "extension", "email", "officeCode", "jobTitle"];
		$data = [];
		foreach ($keys as $key) {
			$data[$key] = $_POST[$key];
		}

		$errors = [];
		foreach ($data as $key => $value) {
			if ($value === "") {
				$errors[] = "The field $key is required";
			}
		}

		if ($_POST["reportsTo"] === "") {
			$data["reportsTo"] = null;
		} else {
			$data["reportsTo"] = $_POST["reportsTo"];
		}

		if (count($errors) > 0) {
			$this->addEmployeePage(false, $errors);
			return;
		}

		try {
			$model = new EmployeesModel();
			$model->addEmployee($data);
			$this->addEmployeePage(true);
		} catch (\Exception $e) {
			$errors[] = $e->getMessage();
			$this->addEmployeePage(false, $errors);
		}
	}
}
