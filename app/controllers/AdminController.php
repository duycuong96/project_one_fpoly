<?php
namespace App\Controllers;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AdminController{

    public function index(){
        include_once './app/views/backend/home/index.php';
    }

    public function login(){
        include_once './app/views/backend/login.php';
    }

    public function postLogin(){
        include_once './app/views/backend/post-login.php';
    }

    public function forgot(){
        include_once './app/views/backend/forgot.php';
    }
    public function postForgot(){
        $email = $_POST['email'];
        // $user = new User();
        // $user = User::where(['email','=',$email])->first();
        // $pass =  $user->password;
        $content = "";
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
		    $mail->Subject = 'Lấy lại mật khẩu';
		    $mail->Body    = $content;
		    $mail->send();
            header('location: ' . ADMIN_URL .'/forgot');
            die;
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
    }
    public function register(){
        include_once './app/views/backend/register.php';
    }
    
}
?>