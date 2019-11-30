<?php 
namespace App\Controllers;


use App\Models\Voucher;

class VoucherController
{
	
	// list
	public function listVoucher(){	
		$vouchers = Voucher::all();
		
		include_once './app/views/backend/vouchers/list.php';
	}
	// thêm mới
	public function addVoucher(){
		include_once './app/views/backend/vouchers/add.php';
	}
	public function saveAddVoucher(){
		$code = isset($_POST['code']) == true ? $_POST['code'] : "";
		$start_time = isset($_POST['start_time']) == true ? $_POST['start_time'] : "";
		$end_time = isset($_POST['end_time']) == true ? $_POST['end_time'] : "";
		$discount_price = isset($_POST['discount_price']) == true ? $_POST['discount_price'] : "";
		$used_count = isset($_POST['used_count']) == true ? $_POST['used_count'] : "";
		$status = isset($_POST['status']) == true ? $_POST['status'] : "";

		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$created_at = date('Y-m-d H:i:s');

		$data = compact('code', 'start_time', 'end_time', 'discount_price', 'used_count', 'status', 'created_at');
		// dd($data);
		$model = new Voucher();
		$model->insert($data);
		header('Location: ../voucher');
	}
	// chỉnh sửa
	public function editVoucher(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$voucher = Voucher::where(['id', '=', $id])->first();
		if(!$voucher){
			header('location: ' . ADMIN_URL);
        	die;
		}
		include_once './app/views/backend/vouchers/edit.php';
	}
	
}

 ?>