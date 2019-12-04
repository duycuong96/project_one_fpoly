<?php
namespace App\Controllers;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class AdminController{

    public function index(){
        include_once './app/views/admin/home/home.php';
    }



    
}
?>