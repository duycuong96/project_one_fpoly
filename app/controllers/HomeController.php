<?php 
namespace App\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Car;
use App\Models\Comment;
use App\Models\Location;
use App\Models\Maker;
use App\Models\Order;
use App\Models\OrderDetail;
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
		$categoryId = isset($_GET['categoryId']) == true ? $_GET['categoryId'] : "";
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		$cars = Car::where(['location_id', '=', $locationId])->andWhere(['cate_id','=',$categoryId])->get();
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
		$comments= Comment::rawQuery('SELECT * 
																	FROM comments 
																	INNER JOIN users 
																	ON comments.user_id = users.id
																	WHERE comments.status = 1
																	AND comments.product_id =' . $id)->get();
		// dd($comments);

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

		if (isset($_SERVER['PHP_SELF'])) {
			// pass
			// dd($_SESSION['AUTH']);
			$err_checkout = "";
			if ($_SESSION['AUTH'] == null) {
				$err_checkout = "Đăng nhập để có thể bình luận được bạn nhé!";
			}
			$err_title = "";
			if ($title == "" || strlen($title) < 2) {
				$err_title = "Tiêu đề quá ngắn";
			}

			$err_content = "";
			if ($content == "" || strlen($content) < 6) {
				$err_content = "Nội dung bình luận quá ngắn";
			}


			// kiểm tra và hiện validation
			if ($err_checkout != "" || $err_title != "" || $err_content != "") {
				header(
					'location: ' . BASE_URL . '/detail?id=' .$product_id
						. '&err_checkout=' . $err_checkout
						. '&err_title=' . $err_title
						. '&err_content=' . $err_content
				);
				die;
			}
		}

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
	public function addWishlist()
	{
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
		// dd(1);
		// SHOW DANH SÁCH MENU
		$id = isset($_GET['id']) == true ? $_GET['id'] : "";
		$customer_address = isset($_GET['customer_address']) == true ? $_GET['customer_address'] : "";
		$date_start = isset($_GET['date_start']) == true ? $_GET['date_start'] : "";
		$date_end = isset($_GET['date_end']) == true ? $_GET['date_end'] : "";
		$voucher = isset($_GET['voucher']) == true ? $_GET['voucher'] : "";
		$maker = Maker::all();
		$loca = Location::where(['show_location', '=', '1'])->get();
		$cate = Category::all();
		// dd($id);
		$car= Car::where(['id', '=', $id])->first();
		// dd($car);
		// tính ngày
		$minus = abs(strtotime($date_end) - strtotime($date_start));

		$year = floor($minus / (365 * 60 * 60 * 24));
		$month = floor(($minus - $year * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
		$day = floor(($minus + $year * 365 * 60 * 60 * 24 + $month * 30 * 60 * 60 * 24) / (60 * 60 * 24));  
		  // dd($day);
		include_once './app/views/client/home/checkout.php';
	}
	public function postCheckout()
	{
		$customer_name = isset($_POST['customer_name']) == true ? $_POST['customer_name'] : "";
		$customer_email = isset($_POST['customer_email']) == true ? $_POST['customer_email'] : "";
		$customer_phone_number = isset($_POST['customer_phone_number']) == true ? $_POST['customer_phone_number'] : "";
		$customer_address = isset($_POST['customer_address']) == true ? $_POST['customer_address'] : "";
		$total_price = isset($_POST['total_price']) == true ? $_POST['total_price'] : "";
		$buyer_id = isset($_POST['buyer_id']) == true ? $_POST['buyer_id'] : "";
		$message = isset($_POST['message']) == true ? $_POST['message'] : "";
		$payment_method = isset($_POST['payment_method']) == true ? $_POST['payment_method'] : "";
		$date_start = isset($_POST['date_start']) == true ? $_POST['date_start'] : "";
		$date_end = isset($_POST['date_end']) == true ? $_POST['date_end'] : "";
		$car_id = isset($_POST['car_id']) == true ? $_POST['car_id'] : "";
		$unit_price = isset($_POST['unit_price']) == true ? $_POST['unit_price'] : "";
		$count_day = isset($_POST['count_day']) == true ? $_POST['count_day'] : "";
		$status=1;
		// dd($customer_address);
		$data = compact('customer_name', 'customer_email', 'customer_phone_number', 'customer_address', 'total_price', 'status', 'buyer_id', 'message', 'payment_method', 'date_start', 'date_end');
		// dd($data);
		$model = new Order();
		$model->insert($data);
		$newOrder = Order::sttOrderBy('id', false)->limit(1)->first();
		// dd($newOrder);
		$order_id = $newOrder->id;
		// dd($order_id);
		$dataDetail =compact('order_id','car_id', 'unit_price');
		$modelDetail = new OrderDetail();
		$modelDetail->insert($dataDetail);
		$orderDetail = OrderDetail::where(['order_id', '=', $order_id])->first();
		// dd($orderDetail->car_id);
		// dd($dataDetail);
		$message = '<div style="width: 600px; margin: 0 auto; padding: 0 auto;">';
		$message .= '<div style="border: 1px dotted #007bff; padding:10px">';
		$message .= 'Cảm ơn các bạn đã tin tưởng Mego !!';
		$message .= '</div>';
		$message .= '<div><h2>Cảm ơn quý khách đã đặt hàng</h2>';
		$message .= '<p>Mego thông báo đơn hàng của quý khách đã được tiếp nhận và đang trong quá trình xử lý.</p></div>';
		$message .= '<div><h4>Thông tin đơn hàng #';
		$message .= $order_id;
		$message .= '</h4><hr>';
		$message .= '<table style="width: 100%;">';
		$message .= '<tr><th style="width: 50%; text-align: left;">Thông tin thanh toán</th><th style="width: 50%; text-align: left;">Địa chỉ giao hàng</th></tr>';
		$message .= '<tr><td>';
		$message .= $customer_name;
		$message .= '<br>';
		$message .= $customer_email;
		$message .= '<br>';
		$message .= $customer_phone_number;
		$message .= '</td><td>';
		$message .= $customer_address;
		$message .= '<br>';
		$message .= $customer_phone_number;
		$message .= '</td></tr></table>';
		$message .= '<p>Phương thức thanh toán: Thanh toán khi nhận xe';
		$message .= '</p></div>';

		$message .= '<h4>Chi tiết đơn hàng</h4><hr>';
		$message .= '<table style="width: 100%;"><tr><th style="text-align: left;">Tên xe</th><th style="text-align: left;">Đơn giá</th><th style="text-align: left;" >Số ngày</th><th style="text-align: left;" >Thành tiền</th></tr><tr>';
		$message .= '<td>';
		$message .= $orderDetail->getNameCar();
		$message .= '</td><td>';
		$message .= $unit_price;
		$message .= '</td><td>';
		$message .= $count_day;
		$message .= '</td><td>';
		$message .= $total_price;
		$message .= '</td></tr><tr>';
		$message .= '<td colspan="3"><b>Tổng giá trị đơn hàng</b></td><td>';
		$message .= $total_price;
		$message .= '</td></tr></table>';

		$message .= '<div><h4>Một lần nữa cảm ơn quý khách</h4></div>';
		$message .= '</div>';

		$mail = new PHPMailer(true);
		try {
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->CharSet = 'UTF-8';
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username = 'd3tmobilebk@gmail.com';
			$mail->Password = 'd3t123456789';
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;
			$mail->setFrom('phuoctrank51a6@gmail.com', 'Mego');
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$emails = explode(",", $customer_email);
			foreach ($emails as $e) {
				$mail->addAddress($e);
			}
			$mail->isHTML(true);
			$mail->Subject = $customer_name;
			$mail->Body    = $message;
			$mail->send();
			echo 'Message has been sent';
			header('location: ' . BASE_URL);
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
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
		$cars=OrderDetail::rawQuery('SELECT *
																FROM order_detail
																INNER JOIN cars ON order_detail.car_id = cars.id
																INNER JOIN orders ON order_detail.order_id = orders.id
																WHERE orders.buyer_id = ' . $id)->get();
		// dd($cars);
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