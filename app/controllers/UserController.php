<?php 
namespace App\Controllers;


use App\Models\User;

class UserController
{
	
	// list
	public function listUser(){	
		$users = User::all();
		
		include_once './app/views/backend/users/list.php';
	}
	// thêm mới
	public function addUser(){
		include_once './app/views/backend/users/add.php';
	}
	// sửa
	public function editUser(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$user = User::where(['id', '=', $id])->first();
		if(!$user){
			header('location: ' . ADMIN_URL);
        	die;
		}
		include_once './app/views/backend/users/edit.php';
	}
	
}

 ?>