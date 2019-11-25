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
	// thêm mới
	public function addUser(){
		include_once './app/views/backend/users/add.php';
	}
	// sửa
	public function editUser(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$user = Order::where(['id', '=', $id])->first();
		if(!$user){
			header('location: ' . ADMIN_URL);
        	die;
		}
		include_once './app/views/backend/users/edit.php';
	}
	
}
