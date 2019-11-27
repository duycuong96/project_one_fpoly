<?php

namespace App\Controllers;


use App\Models\WebSetting;

class WebSettingController
{

  // list
  public function listWebSetting()
  {
    // dd(1);
    $setting = WebSetting::all();

    include_once './app/views/backend/setting/list.php';
  }
  // thêm mới
  public function addUser()
  {
    include_once './app/views/backend/users/add.php';
  }
  // sửa
  public function editUser()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $user = WebSetting::where(['id', '=', $id])->first();
    if (!$user) {
      header('location: ' . ADMIN_URL);
      die;
    }
    include_once './app/views/backend/users/edit.php';
  }
}
