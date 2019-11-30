<?php 
namespace App\Controllers;


use App\Models\User;
use App\Models\Role;

class UserController
{
	
	// list
	public function listUser(){	
		$users = User::all();
		
		include_once './app/views/backend/users/list.php';
	}
	// thêm mới
	public function addUser(){
		$roles = Role::all();
		include_once './app/views/backend/users/add.php';
	}
	public function saveAddUser(){
		$name = isset($_POST['name']) == true ? $_POST['name']: "";
		$email = isset($_POST['email']) == true ? $_POST['email']: "";
		$password = isset($_POST['password']) == true ? $_POST['password']: "";
		$role_id = isset($_POST['role_id']) == true ? $_POST['role_id']: "";
		$status = isset($_POST['status']) == true ? $_POST['status']: "";

		$avatar = $_FILES['avatar'];

		if ($avatar['size'] > 0) {
			$filename = $avatar['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($avatar['tmp_name'], 'public/assets/img/users/' . $filename);
		}

		$data = compact('name', 'email', 'password', 'role_id', 'status');
		$data['avatar'] = $filename;
		// var_dump($data);die;
		$model = new User();
		$model->insert($data);

		header('location: ' . ADMIN_URL . '/account');
		
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

	// xóa

	public function delUser($id){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$user = User::destroy($id);
		header('location: ' . ADMIN_URL . '/account');
	}
	
}

 ?>