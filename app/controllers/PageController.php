<?php

namespace App\Controllers;


use App\Models\Page;

class PageController
{

  // list
  public function listPage()
  {
    // dd(1);
    $page = Page::all();

    include_once './app/views/backend/page/list.php';
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
    $user = Page::where(['id', '=', $id])->first();
    if (!$user) {
      header('location: ' . ADMIN_URL);
      die;
    }
    include_once './app/views/backend/users/edit.php';
  }
}
