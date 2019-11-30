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
  public function addPage()
  {
    include_once './app/views/backend/page/add.php';
  }
  public function saveAddPage()
  {
    // dd(1);
    $title = isset($_POST['title']) == true ? $_POST['title'] : "";
    $description = isset($_POST['description']) == true ? $_POST['description'] : "";

    $data = compact('title', 'description');
    $model = new Page();
    $model->insert($data);
    header('Location: ../page');
  }
  // sửa
  public function editPage()
  {
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $page = Page::where(['id', '=', $id])->first();
    if (!$page) {
      header('location: ' . ADMIN_URL);
      die;
    }
    include_once './app/views/backend/page/edit.php';
  }
  public function SaveEditPage()
  {
    $id = isset($_POST['id']) == true ? $_POST['id'] : "";
    $title = isset($_POST['title']) == true ? $_POST['title'] : "";
    $description = isset($_POST['description']) == true ? $_POST['description'] : "";
    $data = compact('title', 'description');
    $model = new Page();
    $model = Page::where(['id', '=', $id])->first();
    $model->update($data);
    header("Location: ../page/edit?id=$id");
  }
  public function delPage($id)
  {
    $id = $_GET['id'];
    $page = Page::destroy($id);
    header('Location: ../page');
  }

}
