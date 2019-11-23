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

	
}

 ?>