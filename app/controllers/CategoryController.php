<?php 
namespace App\Controllers;


use App\Models\Category;

class CategoryController
{
	
	// list
	public function listCategory(){	
		$categories = Category::all();
		
		include_once './app/views/backend/categories/list.php';
	}

	public function addCategory(){
		include_once './app/views/backend/categories/add.php';
	}
	public function saveAddCategory(){
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$description = isset($_POST['description']) == true ? $_POST['description'] : "";
		$show_menu = isset($_POST['show_menu']) == true ? $_POST['show_menu'] : "";

		$data = compact('name', 'description', 'show_menu');
		$model = new Category();
		$model->insert($data);
		header('Location: ../category');
	}

	public function editCategory(){
		$id = $_GET['id'];
		$cate = Category::where(['id','=',$id])->first();
		include_once './app/views/backend/categories/edit.php';
	}
	public function editSaveCategory()
	{
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$description = isset($_POST['description']) == true ? $_POST['description'] : "";
		$show_menu = isset($_POST['show_menu']) == true ? $_POST['show_menu'] : "";
		$data = compact('name', 'description', 'show_menu');
		$model = new Category();
		$model = Category::where(['id', '=', $id])->first();
		$model->update($data);
		// var_dump($model);die;
		header("Location: ../category/edit?id=$id");
	}

	public function delCategory($id)
	{
		$id = $_GET['id'];
		$cate=Category::destroy($id);
		header('Location: ../category');
	}
}

 ?>