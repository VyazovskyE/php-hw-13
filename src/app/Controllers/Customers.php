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
		$page = $_GET['page'] ?? 1;
		if (intval($page <= 0)) {
			$page = 1;
		}
		$perPage = 10;
		$model = new CustomersModel();
		$data = $model->getCustomers($perPage, $page);
		Renderer::render('customers', 'Customers', [
			'customers' => $data['list'],
			'totalPages' => ceil($data['total'] / $perPage),
			'currentPage' => $page,
		]);
	}

	public function addCustomer(): void
	{
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->addCustomerPage();
		} else {
			$this->addCustomerRequest();
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

	public function addCustomerRequest()
	{
		$requiredKeys = ['customerNumber', 'customerName', 'contactLastName', 'contactFirstName', 'phone', 'addressLine1', 'city', 'state', 'postalCode', 'country'];
		$optionalKeys = ['addressLine2', 'state', 'postalCode', 'salesRepEmployeeNumber', 'creditLimit'];

		$data = [];

		foreach ($requiredKeys as $key) {
			$data[$key] = $_POST[$key];
		}

		foreach ($optionalKeys as $key) {
			if (isset($_POST[$key])) {
				$data[$key] = $_POST[$key];
			}
		}

		$errors = [];
		foreach ($data as $key => $value) {
			if ($value === '') {
				$errors[] = "The field $key is required";
			}
		}

		if (count($errors) > 0) {
			$this->addCustomerPage(false, $errors);
			return;
		}

		try {
			$model = new CustomersModel();
			$model->addCustomer($data);
			$this->addCustomerPage(true);
		} catch (\Exception $e) {
			$this->addCustomerPage(false, [$e->getMessage()]);
		}
	}
}
