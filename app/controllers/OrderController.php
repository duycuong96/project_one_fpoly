<?php 
namespace App\Controllers;


use App\Models\Order;

class OrderController
{
	
	// list
	public function listOrder(){
		// dd(1);
		$orders = Order::all();
		
		include_once './app/views/backend/orders/list.php';
	}
	// Cập nhật
	public function editOrder(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$order = Order::where(['id', '=', $id])->first();
		if(!$order){
			header("location: ../order/edit?id=$id");
        	die;
		}
	}
	
}
