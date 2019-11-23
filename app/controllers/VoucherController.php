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