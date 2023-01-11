<?php
namespace App\Controllers;
use App\Models\Customers as CustomersModel;
use Core\APIRenderer;

class Customers
{
	public function get()
	{
		$model = new CustomersModel();
		$data = $model->getCustomers();
		APIRenderer::renderList($data);
	}
}
