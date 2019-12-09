<?php 
namespace App\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Car;
use App\Models\Comment;
use App\Models\Location;
use App\Models\Maker;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class HomeController
{
	// trang chủ
	public function index(){
		$maker= Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate= Category::all();
		$cars= Car::all();
		include_once './app/views/client/home/homepage.php';
	}

	public function errorPage(){
		include_once './app/views/error.php';
	}
	public function login()
	{
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		include_once './app/views/login.php';
	}
	public function postLogin()
	{
		$email = isset($_POST['email']) == true ? $_POST['email'] : "";
		$password = isset($_POST['password']) == true ? $_POST['password'] : "";
		$model = User::where(['email', '=', $email])->first();
		// dd($model);
		$user = $model->email;
		$pass_sql = $model->password;
		// dd($pass_sql);
		if($model != null && password_verify($password, $pass_sql)) {

			$_SESSION['AUTH'] = [
				'name' => $model->name,
				'email' => $model->email,
				'id' => $model->id,
				'role_id' => $model->role_id
			];
			// dd($_SESSION['AUTH']);
			header("Location: ./");
		}
		else {
			echo "thất bại";
		}
	}
	public function register()
	{
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		include_once './app/views/client/home/register.php';
	}
	public function saveRegister()
	{
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$email = isset($_POST['email']) == true ? $_POST['email'] : "";
		$pass = isset($_POST['password']) == true ? $_POST['password'] : "";
		$password =	password_hash($pass, PASSWORD_DEFAULT);
		$role_id = 3;
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		// dd($created_at);
		$avatar = $_FILES['avatar'];
		$filePath = "";
		if ($avatar['size'] > 0) {
			$filename = $avatar['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($avatar['tmp_name'], "public/assets/img/users/" . $filename);
		}
		// dd($filename);
		$data = compact('name', 'email', 'password', 'role_id');
		$data['avatar'] = $filename;
		$data['created_at'] = date_format(date_create(), 'Y-m-d H:i:s');
		// dd($data);
		$model = new User();
		$model->insert($data);
		// dd($model);
		header('Location: ' . BASE_URL . 'login');
	}
	// logout
	public function logout()
	{
		// $_SESSION['AUTH'] = null;
		if (isset($_SESSION['AUTH'])) {
			// dd($_SESSION['AUTH']);
			unset($_SESSION['AUTH']); // xóa session login
			include_once './app/views/login.php';
			// header('location: ' . BASE_URL . 'login');
		}
	}
	// trang danh mục
	public function categories()
	{
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$cars = $car = Car::all();
		// echo "<pre>";
		// dd($car);
		include_once './app/views/client/home/category.php';
	}
	public function category()
	{
		$id = isset($_GET['id']) == true ? $_GET['id'] : "";
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$cars = Car::where(['cate_id', '=', $id])->get();
		// dd($cars);
		// echo "<pre>";
		// dd($car);
		include_once './app/views/client/home/category.php';
	}
	public function makers()
	{
		$id = isset($_GET['id']) == true ? $_GET['id'] : "";
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$car = Car::all();

		$cars = Car::where(['maker_id', '=',$id])->get();
		// dd($makers);
		// echo "<pre>";
		// dd($car);
		include_once './app/views/client/home/category.php';
	}
	public function locations()
	{
		$id = isset($_GET['id']) == true ? $_GET['id'] : "";
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$car = Car::all();

		$cars = Car::where(['location_id', '=', $id])->get();
		// dd($makers);
		// echo "<pre>";
		// dd($car);
		include_once './app/views/client/home/category.php';
	}
	// chi tiết xe
	public function detail()
	{
		$id = isset($_GET['id']) == true ? $_GET['id'] : "";
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();

		$detail = Car::where(['id', '=', $id])->first();
		$listLoca = Car::where(['location_id', '=', $id])->get();
		// dd($detail);
		include_once './app/views/client/home/detail.php';
	}
	public function contact()
	{
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		include_once './app/views/client/home/contact.php';
	}
	// public function addCart(){
	// 	$id = isset($_GET['id']) == true ? $_GET['id'] : null;

	// 	$car = Car::where(['id', '=', $id])->first();
	// 	// dd($car->feature_image);
	// 	if ($car == null) {
	// 		header('location: ' . BASE_URL);
	// 		die;
	// 	}
	// 	$item = [
	// 		'id' => $car->id,
	// 		'name' => $car->name,
	// 		'image' => $car->feature_image,
	// 		'price' => $car->price,
	// 		'quantity' => 1
	// 	];

	// 	if (!isset($_SESSION[CART]) || count($_SESSION[CART]) == 0) {
	// 		$_SESSION[CART][] = $item;
	// 	} else {
	// 		$cart = $_SESSION[CART];
	// 		$existed = false;

	// 		for ($i = 0; $i < count($cart); $i++) {
	// 			if ($cart[$i]['id'] == $car->id) {
	// 				$existed = true;
	// 				$cart[$i]['quantity'] += 1;
	// 				break;
	// 			}
	// 		}

	// 		if ($existed == false) {
	// 			$cart[] = $item;
	// 		}

	// 		$_SESSION[CART] = $cart;
	// 	}
	// 	// dd($_SESSION[CART]);
	// 	header('location: ' . BASE_URL);
	// 	die;
	// }
	// public function cart()
	// {
	// 	// SHOW DANH SÁCH MENU
	// 	$maker = Maker::all();
	// 	$loca = Location::where(['show_location', '=', '1'])->get();
	// 	$cate = Category::all();

	// 	$cart = isset($_SESSION[CART]) == true ? $_SESSION[CART] : [];
	// 	// dd($cart);
	// 	if (count($cart) <= 0) {
	// 		header('location: ' . BASE_URL);
	// 		die;
	// 	}
	// 	include_once './app/views/client/home/cart.php';
	// }
	public function checkout()
	{
		// SHOW DANH SÁCH MENU
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();

		$cart = $_SESSION[CART];
		// dd($cart[0]['name']);
		// $car= Car::where(['id', '=', $id])->first();
		// dd($car);
		include_once './app/views/client/home/checkout.php';
	}
	public function account()
	{
		// SHOW DANH SÁCH MENU
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$id= $_SESSION['AUTH']['id'];
		// dd($id);
		$user = User::where(['id', '=', $id])->first();
		// dd($user->name);
		// dd($account['id']);
		include_once './app/views/client/home/account.php';
	}
	public function changePassword()
	{
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$id = $_SESSION['AUTH']['id'];
		// dd($id);
		$user = User::where(['id', '=', $id])->first();
		include_once './app/views/client/home/changePassword.php';
	}
	public function saveChangePassword()
	{
		$rePassword = $_POST['rePassword'];
		$passwordNow = isset($_POST['passwordNow']) == true ? $_POST['passwordNow'] : null;
		$newPassword = isset($_POST['newPassword']) == true ? $_POST['newPassword'] : null;
		$password = password_hash($newPassword, PASSWORD_DEFAULT);
		// dd($password);
		$id = $_SESSION['AUTH']['id'];
		// dd($passwordNow);
		$user = User::where(['id', '=', $id])->first();

		$pass_sql = $user->password;
		// dd($passwordNow);

		if (password_verify($passwordNow, $pass_sql)) {
			// echo 'thanh cong';
			$data = compact('password');
			// dd($data);
			$model = new User();
			$model = User::where(['id', '=', $id])->first();
			// dd($model);
			$model->update($data);
			header("Location: " .BASE_URL . 'account');
			// dd($model);
		}else{
			echo 'that bai';
		}
		include_once './app/views/client/home/changePassword.php';
	}


	public function history()
	{
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$id = $_SESSION['AUTH']['id'];
		// dd($id);
		$user = User::where(['id', '=', $id])->first();

		include_once './app/views/client/home/history.php';
	}


	
	public function mailForm(){
		$menus = Category::where(['show_menu', '=', 1])->get();
		include_once './app/views/client/home/mail-form.php';
	}
	public function sendMail(){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$content = $_POST['content'];
		$err_mail = "Gửi không thành công";

		if (isset($_POST["submit"])) {
			// validate tên
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên";
			}
			 // validate email
			 $err_email = "";
			 if($email == ""){
				 $err_email = "Vui lòng nhập email";
			 } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
				 $err_email = "Email nhập chưa đúng";
			 }
			 // validate tiêu đề
			 $err_subject = "";
			 if($subject == ""){
				 $err_subject = "Vui lòng nhập tiêu đề nội dung";
			 }
			 // validate nội dung
			 $err_content = "";
			 if($content == ""){
				 $err_content = "Vui lòng nhập nội dung";
			 }

			  // kiểm tra và hiện validate
			  if($err_email != "" || $err_subject != "" || $err_content != "" || $err_name != ""){
				header('location: ' . BASE_URL . 'contact?'
								. 'err_email=' . $err_email
								. '&err_subject=' . $err_subject
								. '&err_content=' . $err_content
								. '&err_name=' . $err_name
								); die;
			}
		}
		// dd($content);
		$mail = new PHPMailer(true);
		try {
		    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
		    $mail->CharSet = 'UTF-8';
		    $mail->isSMTP(); 
		    $mail->Host       = 'smtp.gmail.com';
		    $mail->SMTPAuth   = true;
		    $mail->Username = 'noiconsong@gmail.com';
		    $mail->Password = 'cuong16051996';
		    $mail->SMTPSecure = 'tls';
			$mail->Port = 587; 
			                                   
			$mail->setFrom('vuduycuong996@gmail.com', 'Cuong Poly');
			
		    $mail->addAddress($email);
		    $mail->isHTML(true);
		    $mail->Subject = $subject;
		    $mail->Body    = $content;
		    $mail->send();
		    header('location: ' . BASE_URL .'contact');die;
		} catch (Exception $e) {
		    header('location: ' . BASE_URL .'contact?' . 'err_mail=' . $err_mail);die;
		}
	}
}


 ?>