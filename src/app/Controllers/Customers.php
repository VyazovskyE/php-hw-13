<?php
namespace App\Controllers;
use App\Models\Customers as CustomersModel;
use App\Models\Employees as EmployeesModel;
use Core\APIRenderer;
use Core\Renderer;

class Customers
{
	public function get(): void
	{
		$model = new CustomersModel();
		$data = $model->getCustomers();
		APIRenderer::renderList($data);
	}

	public function addCustomer(): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->addCustomerPage();
		}
	}

	public function addCustomerPage(bool $success = false, array $errors = []): void
	{
		$employeesModel = new EmployeesModel();
		$data = $employeesModel->getEmployees();
		$employees = $data['list'];

		Renderer::render('addCustomer', 'Add Customer', [
			'employees' => $employees,
			'success' => $success,
			'errors' => $errors,
		]);
	}
}
