<?php 
namespace App\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Car;
use App\Models\Comment;
use App\Models\Location;
use App\Models\Maker;
use App\Models\Order;
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

		if (isset($_SERVER['PHP_SELF'])) {
			$err_email = "";
			if ($email == "") {
				$err_email = "Vui lòng nhập địa chỉ Email";
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$err_email = "Email nhập chưa đúng";
			} elseif ($model == null) {
				$err_email = "Địa chỉ Email chưa đúng";
			}
			// pass
			$err_password = "";
			if ($password == "" || strlen($password) < 6) {
				$err_password = "Nhập mật khẩu ít nhất 6 kí tự";
			}elseif (!password_verify($password, $pass_sql)) {
				$err_password = "Mật khẩu chưa chính xác";
			}

			// kiểm tra và hiện validation
			if ($err_email != "" || $err_password != "") {
				header(
					'location: ' . BASE_URL . '/login?'
						. 'err_email=' . $err_email
						. '&err_password=' . $err_password
				);
				die;
			}
		}
			// dd($model);
		if(password_verify($password, $pass_sql)) 
		{
			$_SESSION['AUTH'] = [
				'name' => $model->name,
				'email' => $model->email,
				'avatar' => $model->avatar,
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
		$phone_number = isset($_POST['phone_number']) == true ? $_POST['phone_number'] : "";
		$pass = isset($_POST['password']) == true ? $_POST['password'] : "";
		$rePassword = isset($_POST['rePassword']) == true ? $_POST['rePassword'] : "";
		$password =	password_hash($pass, PASSWORD_DEFAULT);
		$role_id = 3;
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		// dd($created_at);
		$avatar = $_FILES['avatar'];
		$filePath = "";
		
		// dd($filename);


		if (isset($_SERVER['PHP_SELF'])) {
			$err_name = "";
			if($name = "" || strlen($name) <2){
				$err_name = 'Vui lòng điền họ và tên';
			}

			$err_email = "";
			if ($email == "") {
				$err_email = "Vui lòng nhập địa chỉ Email";
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$err_email = "Email nhập chưa đúng";
			}

			$err_phone_number = '';
			if($phone_number = ''){
				$err_phone_number = 'Vui lòng nhập số điện thoại';
			}elseif (!is_int($phone_number)) {
				$err_phone_number = "Vui lòng nhập đúng số điện thoại không '.' hoặc ',' ";
			}elseif (strlen($phone_number)<10) {
				$err_phone_number = "Số điện thoại ở Việt Nam hiện tại có 10 số";
			}
			// pass
			$err_password = "";
			if ($pass == "" || strlen($pass) < 6) {
				$err_password = "Nhập mật khẩu ít nhất 6 kí tự";
			}
			
			$err_rePassword = '';
			if (strcmp($password, $rePassword) != 0) {
				$err_rePassword = 'mật khẩu nhập không trùng khớp';
			}
			// ảng
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
			if ($err_email != "" || $err_password != "") {
				header(
					'location: ' . BASE_URL . '/register?'
						. 'err_name=' . $err_name
						. '&err_email=' . $err_email
						. '&err_phone_number=' . $err_phone_number
						. '&err_password=' . $err_password
						. '&err_rePassword=' . $err_rePassword
						. '&err_file=' . $err_file
				);
				die;
			}
		}

		$data = compact('name', 'email', 'password', 'role_id', 'phone_number');
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
	public function search()
	{
		$locationId = isset($_GET['locationId']) == true ? $_GET['locationId'] : "";
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$cars = Car::where(['location_id', '=', $locationId])->get();
		// dd($cars);
		include_once './app/views/client/home/category.php';

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
	public function comment(){
		$product_id = isset($_POST['product_id']) == true ? $_POST['product_id'] : "";
		$title = isset($_POST['title']) == true ? $_POST['title'] : "";
		$rating = isset($_POST['rating']) == true ? $_POST['rating'] : "";
		$content = isset($_POST['content']) == true ? $_POST['content'] : "";
		$user_id = $_SESSION['AUTH']['id'];
		$status = 1;
		// dd($user_id);	
		// dd($rating);
		$data = compact('title', 'rating', 'content','product_id', 'user_id', 'status');
		$model = new Comment();
		$model->insert($data);
		header('location: '. BASE_URL .'detail?id=' . $product_id);
	}
	public function contact()
	{
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		include_once './app/views/client/home/contact.php';
	}
	public function addWishlist(){
		$id = isset($_GET['id']) == true ? $_GET['id'] : null;

		$car = Car::where(['id', '=', $id])->first();
		// dd($car->feature_image);
		if ($car == null) {
			header('location: ' . BASE_URL);
			die;
		}
		$item = [
			'id' => $car->id,
			'name' => $car->name,
			'image' => $car->feature_image,
			'price' => $car->price,
			'location_id' => $car->location_id,
			'quantity' => 1
		];

		if (!isset($_SESSION[CART]) || count($_SESSION[CART]) == 0) {
			$_SESSION[CART][] = $item;
		} else {
			$cart = $_SESSION[CART];
			$existed = false;

			for ($i = 0; $i < count($cart); $i++) {
				if ($cart[$i]['id'] == $car->id) {
					$existed = true;
					$cart[$i]['quantity'] += 1;
					break;
				}
			}

			if ($existed == false) {
				$cart[] = $item;
			}

			$_SESSION[CART] = $cart;
		}
		// dd($_SESSION[CART]);
		header('location: ' . BASE_URL);
		die;
	}
	public function wishlist()
	{
		// SHOW DANH SÁCH MENU
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();

		$carts = isset($_SESSION[CART]) == true ? $_SESSION[CART] : [];
		// dd($carts);
		if (count($carts) <= 0) {
			header('location: ' . BASE_URL);
			die;
		}
		include_once './app/views/client/home/wishlist.php';
	}
	public function delItemWishlist(){
		$carId = isset($_GET['id']) == true ? $_GET['id'] : null;
		$cart = isset($_SESSION[CART]) == true ? $_SESSION[CART] : [];
		$index = false;
		for ($i = 0; $i < count($cart); $i++) {
			if ($cart[$i]['id'] == $carId) {
				$index = $i;
				break;
			}
		}
		if ($index !== false) {
			array_splice($cart, $index, 1);
		}
		$_SESSION[CART] = $cart;
		if (count($cart) == 0) {
			header('location: ' . BASE_URL);
			die;
		} else {
			header('location: ' . BASE_URL . 'wishlist');
			die;
		}
}
	public function checkout()
	{
		// SHOW DANH SÁCH MENU
		$id = isset($_GET['id']) == true ? $_GET['id'] : "";
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		// dd($id);
		$car= Car::where(['id', '=', $id])->first();
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
	public function saveAccount()
	{
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$email = isset($_POST['email']) == true ? $_POST['email'] : "";
		$phone_number = isset($_POST['phone_number']) == true ? $_POST['phone_number'] : "";
		// dd($id);
		if (isset($_SERVER['PHP_SELF'])) {
			// pass
			$err_name = "";
			if ($name == "" || strlen($name) < 2) {
				$err_name = "Vui lòng cập nhật tên ít nhất 2 kí tự";
			}


			$err_email = "";
			if ($email == "") {
				$err_email = "Vui lòng nhập địa chỉ Email";
			} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$err_email = "Cập nhật Email nhập chưa đúng";
			}

			$err_phone_number = "";
			if ($phone_number = "") {
				$err_phone_number = 'Nhập số điện thoại';
			} elseif (!is_int($phone_number)) {
				$err_phone_number = "Cập nhật đúng số điện thoại không '.' hoặc ',' ";
			} elseif (strlen($phone_number) < 10) {
				$err_phone_number = "Số điện thoại ở Việt Nam hiện tại có 10 số";
			}


			// kiểm tra và hiện validation
			if ($err_name != "" || $err_email != "" || $err_phone_number != "") {
				header(
					'location: ' . BASE_URL . '/account?'
						. 'err_name=' . $err_name
						. '&err_email=' . $err_email
						. '&err_phone_number=' . $err_phone_number
				);
				die;
			}
		}
		$data = compact('name','email', 'phone_number');
		$model = new User();
		$model = User::where(['id', '=', $id])->first();
		// dd($model);
		$model->update($data);
		header("Location: " . BASE_URL . 'account');

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
		if (isset($_SERVER['PHP_SELF'])) {
			// pass
			$err_password_now = "";
			if ($passwordNow == "" || strlen($passwordNow) < 6) {
				$err_password_now = "Nhập mật khẩu ít nhất 6 kí tự";
			} elseif (!password_verify($passwordNow, $pass_sql)) {
				$err_password_now = "Mật khẩu không chính xác";
			}

			$err_password_new= "";
			if ($newPassword == "" || strlen($newPassword) < 6) {
				$err_password_new = "Nhập mật khẩu mới ít nhất 6 kí tự";
				}elseif (strcmp($newPassword, $passwordNow) == 0) {
					$err_password_new = "Mật khẩu mới không được giống mật khẩu cũ";
				}

			$err_rePassword = "";
			if (strcmp($newPassword, $rePassword) != 0) {
				$err_rePassword = "Nhập lại mật khẩu không trùng khớp";
			}


			// kiểm tra và hiện validation
			if ($err_password_now != "" || $err_password_new != "" || $err_rePassword != "") {
				header(
					'location: ' . BASE_URL . '/change-password?'
						. 'err_password_now=' . $err_password_now
						. '&err_password_new=' . $err_password_new
						. '&err_rePassword=' . $err_rePassword
				);
				die;
			}
		}
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
		include_once './app/views/client/home/changePassword.php';
		}else{
			echo 'that bai';
		}
	}


	public function history()
	{
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$id = $_SESSION['AUTH']['id'];
		// dd($id);
		$user = User::where(['id', '=', $id])->first();
		$cars=Order::where(['buyer_id', '=', $id])->get();

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