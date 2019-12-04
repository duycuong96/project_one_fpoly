<?php 
namespace App\Controllers;


use App\Models\Car;
use App\Models\Category;
use App\Models\Location;
use App\Models\Makers;

class CarController
{
	
	// list
	public function listCar(){	
		$cars = Car::all();
		$cate = Category::all();
		$loca = Location::all();
		$maker = Makers::all();
		
		include_once './app/views/backend/cars/list.php';
	}
	// add
	public function addCar()
	{
		$cate = Category::all();
		$loca = Location::all();
		$maker = Makers::all();
		include_once './app/views/backend/cars/add.php';
	}
	public function saveAddCar()
	{
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$cate_id = isset($_POST['cate_id']) == true ? $_POST['cate_id'] : "";
		$location_id = isset($_POST['location_id']) == true ? $_POST['location_id'] : "";
		$maker_id = isset($_POST['maker_id']) == true ? $_POST['maker_id'] : "";
		$price = isset($_POST['price']) == true ? $_POST['price'] : "";
		$detail = isset($_POST['detail']) == true ? $_POST['detail'] : "";

		$image = $_FILES['feature_image'];
		$filePath = "";
		if ($image['size'] > 0) {
			$filename = $image['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($image['tmp_name'], 'public/assets/img/cars/' . $filename);
			// $filePath = "public/images/cars/" . $filename;
		}
		// dd($filePath);
		$data = compact('name', 'cate_id', 'location_id', 'maker_id', 'price', 'detail');
		$data['feature_image'] = $filename;
		$model = new Car();
		$model->insert($data);
		header('Location: ../car');
	}
	// edit
	public function editCar()
	{
		$cate = Category::all();
		$loca = Location::all();
		$maker = Makers::all();
		
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$car = Car::where(['id','=',$id])->first();
		if(!$car){
			header('location: ../car');
        	die;
		}
		include_once './app/views/backend/cars/edit.php';
	}
	public function saveEditMaker()
	{
		$cate = Category::all();
		$loca = Location::all();
		$maker = Makers::all();
		include_once './app/views/backend/cars/add.php';
	}
	public function saveEditCar()
	{
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$cate_id = isset($_POST['cate_id']) == true ? $_POST['cate_id'] : "";
		$location_id = isset($_POST['location_id']) == true ? $_POST['location_id'] : "";
		$maker_id = isset($_POST['maker_id']) == true ? $_POST['maker_id'] : "";
		$price = isset($_POST['price']) == true ? $_POST['price'] : "";
		$detail = isset($_POST['detail']) == true ? $_POST['detail'] : "";
		$image = isset($_POST['feature_image']) == true ? $_POST['feature_image'] : "";
		// dd($id);
		$images = $_FILES['feature_images'];
		$filePath = "";
		if ($images['size'] > 0) {
			$filename = $images['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($images['tmp_name'], "public/assets/img/cars/" . $filename);
			// $filePath = "./public/images/cars/" . $filename;
		}
		// dd($filePath);
		if ($images['size'] > 0) {
			$data = compact('name', 'cate_id', 'location_id', 'maker_id', 'price', 'detail');
			$data['feature_image'] = $filename;
		} else {
			$data = compact('name', 'cate_id', 'location_id', 'maker_id', 'price', 'detail', 'image');
		}
		// dd($data);
		$model = new Car();
		$model = Car::where(['id', '=', $id])->first();
		$model->update($data);
		header("Location: ../car/edit?id=$id");
	}

	public function delCar($id)
	{
		$id = $_GET['id'];
		$car = Car::destroy($id);
		header('Location: ../car');
	}
	
}

 ?>