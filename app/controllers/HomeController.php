<?php 
namespace App\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Car;
use App\Models\Comment;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class HomeController
{
	// trang chủ
	public function index(){
		$menus= Category::all();
		include_once './app/views/frontend/home/homepage.php';
	}
	// trang danh mục
	public function category()
	{
		$menus = Category::all();
		$id = isset($_GET['id']) == true ? $_GET['id'] : NULL;
		$car = Car::where(['cate_id', '=', $id])->get();
		// echo "<pre>";
		// dd($car);
		include_once './app/views/frontend/home/category.php';
	}

	
	public function mailForm(){
		$menus = Category::where(['show_menu', '=', 1])->get();
		include_once './app/views/frontend/home/mail-form.php';
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