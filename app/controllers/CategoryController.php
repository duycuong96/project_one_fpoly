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

	public function editCategory(){
		$id = $_GET['id'];
		$cate = Category::where(['id','=',$id])->first();
		include_once './app/views/backend/categories/edit.php';
	}
	
}

 ?>