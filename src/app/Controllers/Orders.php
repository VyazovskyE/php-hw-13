<?php
namespace App\Controllers;
use App\Models\Orders as OrdersModel;
use Core\APIRenderer;

class Orders
{
	public function get()
	{
		$model = new OrdersModel();
		$data = $model->getOrders();
		APIRenderer::renderList($data);
	}
}
