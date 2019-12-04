<?php 
namespace App\Controllers;


use App\Models\User;
use App\Models\Role;

class UserController
{
	
	// list
	public function listUser(){	
		$users = User::all();
		
		include_once './app/views/admin/users/list.php';
	}
	// thêm mới
	public function addUser(){
		$roles = Role::all();
		include_once './app/views/admin/users/add.php';
	}
	public function saveAddUser(){
		$name = isset($_POST['name']) == true ? $_POST['name']: "";
		$email = isset($_POST['email']) == true ? $_POST['email']: "";
		$password = isset($_POST['password']) == true ? $_POST['password']: "";
		$role_id = isset($_POST['role_id']) == true ? $_POST['role_id']: "";
		$status = isset($_POST['status']) == true ? $_POST['status']: "";

		$avatar = isset($_FILES['avatar']) == true ? $_FILES['avatar']: "";
		

		if ($avatar['size'] > 0) {
			$filename = $avatar['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($avatar['tmp_name'], 'public/assets/img/users/' . $filename);
		}
		// mã hóa mật khẩu
		$hashpassword = password_hash($password, PASSWORD_DEFAULT);

		$data = compact('name', 'email', 'role_id', 'status');
		$data['password'] = $hashpassword;
		$data['avatar'] = $filename;
		$data['created_at'] = date_format(date_create(), 'Y-m-d H:i:s');
		// var_dump($data);die;
		$model = new User();
		$model->insert($data);

		header('location: ' . ADMIN_URL . '/account');
		
	}
	// sửa
	public function editUser(){

		$roles = Role::all();
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$user = User::where(['id', '=', $id])->first();
		if(!$user){
			header('location: ' . ADMIN_URL);
        	die;
		}
		include_once './app/views/admin/users/edit.php';
	}
	public function saveEditUser(){

		$id = isset($_POST['id']) == true ? $_POST['id']: "";
		$name = isset($_POST['name']) == true ? $_POST['name']: "";
		$email = isset($_POST['email']) == true ? $_POST['email']: "";
		$password = isset($_POST['password']) == true ? $_POST['password']: "";
		$role_id = isset($_POST['role_id']) == true ? $_POST['role_id']: "";
		$status = isset($_POST['status']) == true ? $_POST['status']: "";

		$avatar = isset($_FILES['avatar']) == true ? $_FILES['avatar']: "";

		if ($avatar['size'] > 0) {
			$filename = $avatar['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($avatar['tmp_name'], 'public/assets/img/users/' . $filename);
		}
		// mã hóa mật khẩu
		$hashpassword = password_hash($password, PASSWORD_DEFAULT);
		$data = compact('name', 'email', 'role_id', 'status');
		$data['password'] = $hashpassword;
		$data['avatar'] = $filename;
		$data['updated_at'] = date_format(date_create(), 'Y-m-d H:i:s');
		// var_dump($data);die;
		$model = new User();
		$model->id = $id;
		$model->update($data);

		header('location: ' . ADMIN_URL . '/account');
	}

	// xóa

	public function delUser($id){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$user = User::destroy($id);
		header('location: ' . ADMIN_URL . '/account');
	}
	
}
