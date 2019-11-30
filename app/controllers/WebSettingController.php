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
  public function addWebSetting()
  {
    include_once './app/views/backend/setting/add.php';
  }
  public function SaveAddWebSetting()
  {
    $address = isset($_POST['address']) == true ? $_POST['address'] : "";
    $email = isset($_POST['email']) == true ? $_POST['email'] : "";
    $hotline = isset($_POST['hotline']) == true ? $_POST['hotline'] : "";

    $logo = $_FILES['logo'];
    $filePath = "";
    if ($logo['size'] > 0) {
      $filename = $logo['name'];
      $filename = uniqid() . "-" . $filename;
      move_uploaded_file($logo['tmp_name'], 'public/assets/img/cars/' . $filename);
    }
    $data = compact('address', 'email', 'hotline');
    $data['logo'] = $filename;
    $model = new WebSetting();
    $model->insert($data);
    header('Location: ../setting');
  }
  // sửa
  public function editWebSetting()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $setting = WebSetting::where(['id', '=', $id])->first();
    if (!$setting) {
      header('location: ' . ADMIN_URL);
      die;
    }
    include_once './app/views/backend/setting/edit.php';
  }
  public function saveEditWebSetting()
  {
    $id = isset($_POST['id']) == true ? $_POST['id'] : "";
    $email = isset($_POST['email']) == true ? $_POST['email'] : "";
    $address = isset($_POST['address']) == true ? $_POST['address'] : "";
    $hotline = isset($_POST['hotline']) == true ? $_POST['hotline'] : "";
    $logo = isset($_POST['logo']) == true ? $_POST['logo'] : "";
    $logoTwo = $_FILES['logoTwo'];
    $filePath = "";
    if ($logoTwo['size'] > 0) {
      $filename = $logoTwo['name'];
      $filename = uniqid() . "-" . $filename;
      move_uploaded_file($logoTwo['tmp_name'], "public/assets/img/cars/" . $filename);
      // $filePath = "./public/images/cars/" . $filename;
    }
    // dd($filePath);
    if ($logoTwo['size'] > 0) {
      $data = compact('email', 'address', 'hotline');
      $data['logo'] = $filename;
    } else {
      $data = compact('email', 'address', 'hotline', 'logo');
    }
    // dd($data);
    $model = new WebSetting();
    $model = WebSetting::where(['id', '=', $id])->first();
    $model->update($data);
    header("Location: ../setting/edit?id=$id");
  }
  public function delWebSetting($id)
  {
    $id = $_GET['id'];
    $setting = WebSetting::destroy($id);
    header('Location: ../setting');
  }
}
