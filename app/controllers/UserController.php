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
	
}

 ?>