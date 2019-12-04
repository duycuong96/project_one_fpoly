<?php

namespace App\Controllers;

use App\Models\User;


class LoginController
{


    public function loginAdmin()
    {
        include_once './app/views/backend/login.php';
    }

    public function postLoginAdmin()
    {
        $email = isset($_POST['email']) == true ? $_POST['email'] : "";
        $password = isset($_POST['password']) == true ? $_POST['password'] : "";

        $user = new User();
        $user = User::where(['email', '=', $email])
                    ->first();
        // var_dump($user);die;
        $pass =  $user->password;
        $role = $user->role_id;
        var_dump($role); die;
        // echo $pass;die;
        if (($user && password_verify($password, $pass))) {
            $_SESSION['AUTH'] = [
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id
            ];
            header('location: ' . ADMIN_URL);
            die;
        } else {

            $err_login    = "Sai email hoặc mật khẩu";
            header(
                'location: ' . ADMIN_URL . '/login?'
                    . '&err_login=' . $err_login
            );
            die;
        }
    }

    public function logoutAdmin(){
        unset($_SESSION['AUTH']);
		header('location: ' . ADMIN_URL);die;
    }
}
