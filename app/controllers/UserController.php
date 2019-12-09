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
		
		if (isset($_SERVER['PHP_SELF'])){
			// tên
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			} else{
				$nameUser = User::where(['name', '=', $name])->get();
				if($nameUser){
					$err_name = "Tên đã tồn tại";
				}
            }
			// validate email
			$err_email = "";
			if($email == ""){
				$err_email = "Vui lòng nhập email";
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$err_email = "Email nhập chưa đúng";
			}
			// pass
			$err_password = "";
			if($password == "" || strlen($password) < 6 ){
				$err_password = "Nhập mật khẩu ít nhất 6 kí tự";
			}

			// ảnh
			$err_file = "";

			$allowed_image_extension = array(
				"png",
				"jpg",
				"jpeg"
			);
		
			// pathinfo trả về thông tin về đường dẫn tệp
			$file_extension = pathinfo($avatar["name"], PATHINFO_EXTENSION);
		
			//  Kiểm tra xem một tập tin hoặc thư mục tồn tại
			if (!file_exists($avatar["tmp_name"])) {
				$err_file = "Vui lòng chọn hình ảnh để tải lên";
			}
			//  Kiểm tra biến tồn tại trong mảng
			else if (!in_array($file_extension, $allowed_image_extension)) {
				$err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
			}
			// move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
			// upload ảnh
			else {
				if ($avatar['size'] > 0) {
					$filename = $avatar['name'];
					$filename = uniqid() . "-" . $filename;
					move_uploaded_file($avatar['tmp_name'], 'public/assets/img/users/' . $filename);
				}
			}
			
		// kiểm tra và hiện validation
		if($err_name != "" || $err_email != "" || $err_password != "" || $err_file != ""){
			header(
				'location: ' . ADMIN_URL . '/account/add'
					. '&err_name=' . $err_name
					. '&err_email=' . $err_email
					. '&err_file=' . $err_file
					. '&err_password=' . $err_password
			);
			die;
		}
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
            header('location: '. BASE_URL . 'error');
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

		if (isset($_SERVER['PHP_SELF'])){
			$user = User::where(['id', '=', $id])->first();
			// tên
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			} elseif ($name != $user->name){
				$nameUser = User::where(['name', '=', $name])->get();
				if($nameUser){
					$err_name = "Tên đã tồn tại";
				}
			}
			// validate email
			$err_email = "";
			if($email == ""){
				$err_email = "Vui lòng nhập email";
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$err_email = "Email nhập chưa đúng";
			}
			// pass
			$err_password = "";
			if($password == "" || strlen($password) < 6 ){
				$err_password = "Nhập mật khẩu ít nhất 6 kí tự";
			}

			// ảnh
			$err_file = "";

			$allowed_image_extension = array(
				"png",
				"jpg",
				"jpeg"
			);
		
			// pathinfo trả về thông tin về đường dẫn tệp
			$file_extension = pathinfo($avatar["name"], PATHINFO_EXTENSION);
		
			//  Kiểm tra xem một tập tin hoặc thư mục tồn tại
			if (!file_exists($avatar["tmp_name"])) {
				$err_file = "Vui lòng chọn hình ảnh để tải lên";
			}
			//  Kiểm tra biến tồn tại trong mảng
			else if (!in_array($file_extension, $allowed_image_extension)) {
				$err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
			}
			// move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
			// upload ảnh
			else {
				if ($avatar['size'] > 0) {
					$filename = $avatar['name'];
					$filename = uniqid() . "-" . $filename;
					move_uploaded_file($avatar['tmp_name'], 'public/assets/img/users/' . $filename);
				}
			}
			
		// kiểm tra và hiện validation
		if($err_name != "" || $err_email != "" || $err_password != "" || $err_file != ""){
			header(
				'location: ' . ADMIN_URL . '/account/edit?id=' . $id
					. '&err_name=' . $err_name
					. '&err_email=' . $err_email
					. '&err_file=' . $err_file
					. '&err_password=' . $err_password
			);
			die;
		}
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

	public function delUser(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		// $user_id =  $_SESSION['AUTH']['id'];
		// var_dump($user_id);die;

			$user = User::destroy($id);
		
		
		header('location: ' . ADMIN_URL . '/account');die;
	}

	public function infomationUser(){
		$user_id = $_SESSION['AUTH']['id'];
	
		$user = User::where(['id', '=', $user_id])->first();
		// var_dump($user);die;
		include_once './app/views/admin/users/info.php';
	}
	
}
