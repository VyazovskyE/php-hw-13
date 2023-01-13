<?php
namespace App\Controllers;
use App\Models\Employees as EmployeesModel;
use Core\APIRenderer;

class Employees
{
	public function get()
	{
		$model = new EmployeesModel();
		$data = $model->getEmployees();
		APIRenderer::renderList($data);
	}

	public function getJobTitles()
	{
		$model = new EmployeesModel();
		$data = $model->getJobTitles();
		APIRenderer::renderList($data);
	}
}
