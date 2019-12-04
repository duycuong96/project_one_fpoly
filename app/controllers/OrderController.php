<?php 
namespace App\Controllers;


use App\Models\Order;
use App\Models\OrderDetail;


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
			header('location: ' . ADMIN_URL);
        	die;
		}
		if($order != ""){
			$orderDetail = OrderDetail::where(['order_id','=', $order->id])->get();
		}
		include_once './app/views/backend/orders/edit.php';
	}
	public function saveEditOrder(){
		
		
		$id = isset($_POST['id']) == true ? $_POST['id']: "";
		$customer_name = isset($_POST['customer_name']) == true ? $_POST['customer_name']: "";
		$customer_phone_number = isset($_POST['customer_phone_number']) == true ? $_POST['customer_phone_number']: "";
		$customer_email = isset($_POST['customer_email']) == true ? $_POST['customer_email']: "";
		$customer_address = isset($_POST['customer_address']) == true ? $_POST['customer_address']: "";
		$status = isset($_POST['status']) == true ? $_POST['status']: "";
		
		$data = compact('customer_name', 'customer_phone_number', 'customer_email', 'customer_address', 'status'  );
		// $data['updated_date'] = date_format(date_create(), 'Y-m-d');
		$model = new Order();
		$model->id = $id;
		var_dump($model);die;
		$model->update($data);
		
		header('location: ' . ADMIN_URL . '/order' );
		
		}
	
	
}
