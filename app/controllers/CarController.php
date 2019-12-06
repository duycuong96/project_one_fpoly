<?php 
namespace App\Controllers;


use App\Models\Car;
use App\Models\Category;
use App\Models\Location;
use App\Models\Makers;
use App\Models\Order;
use App\Models\User;

class CarController
{
	
	// list
	public function listCar(){	
		$cate_id = isset($_GET['cate_id']) == true ? $_GET['cate_id'] : "";
		$location_id = isset($_GET['location_id']) == true ? $_GET['location_id'] : "";
		
		$categories = Category::all();
		$locations = Location::all();
		if($cate_id != "" && $location_id != ""){
			$cars = Car::where(['cate_id','=', $cate_id])->andWhere(['location_id', '=', $location_id])->get();
		} elseif($cate_id != "" && $location_id == ""){
			$cars = Car::where(['cate_id', '=', $cate_id])->get();
		} elseif($cate_id == "" && $location_id != ""){
			$cars = Car::where(['location_id', '=', $location_id])->get();
		}
		else{
			$cars = Car::sttOrderBy('id', false)->get();
		}

	
		
		include_once './app/views/admin/cars/list.php';
	}
	// add
	public function addCar()
	{
		$categories = Category::all();
		$locations = Location::all();
		$makers = Makers::all();
		$users = User::where(['role_id', '=', 2])->orWhere(['role_id', '=', 1])->get();
		// var_dump($users);die;
		include_once './app/views/admin/cars/add.php';
	}
	public function saveAddCar()
	{
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$cate_id = isset($_POST['cate_id']) == true ? $_POST['cate_id'] : "";
		$location_id = isset($_POST['location_id']) == true ? $_POST['location_id'] : "";
		$maker_id = isset($_POST['maker_id']) == true ? $_POST['maker_id'] : "";
		$user_id = isset($_POST['user_id']) == true ? $_POST['user_id'] : "";
		$price = isset($_POST['price']) == true ? $_POST['price'] : "";
		$detail = isset($_POST['detail']) == true ? $_POST['detail'] : "";

		$image = $_FILES['feature_image'];

		if ($image['size'] > 0) {
			$filename = $image['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($image['tmp_name'], 'public/assets/img/cars/' . $filename);
			// $filePath = "public/images/cars/" . $filename;
		}
		// dd($filePath);
		$data = compact('name', 'cate_id', 'location_id', 'maker_id', 'user_id', 'price', 'detail');
		$data['feature_image'] = $filename;
		$model = new Car();
		$model->insert($data);
		header('Location: ../car');
	}
	// edit
	public function editCar()
	{
		$categories = Category::all();
		$locations = Location::all();
		$makers = Makers::all();
		$users = User::where(['role_id', '=', 2])->orWhere(['role_id', '=', 1])->get();
		
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$car = Car::where(['id','=',$id])->first();
		if(!$car){
			header('location: ../car');
        	die;
		}
		include_once './app/views/admin/cars/edit.php';
	}
	public function saveEditMaker()
	{
		$cate = Category::all();
		$loca = Location::all();
		$maker = Makers::all();
		include_once './app/views/admin/cars/add.php';
	}
	public function saveEditCar()
	{
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		$user_id = isset($_POST['user_id']) == true ? $_POST['user_id'] : "";
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$cate_id = isset($_POST['cate_id']) == true ? $_POST['cate_id'] : "";
		$location_id = isset($_POST['location_id']) == true ? $_POST['location_id'] : "";
		$maker_id = isset($_POST['maker_id']) == true ? $_POST['maker_id'] : "";
		$price = isset($_POST['price']) == true ? $_POST['price'] : "";
		$detail = isset($_POST['detail']) == true ? $_POST['detail'] : "";

		$image = $_FILES['feature_image'];

		if ($image['size'] > 0) {
			$filename = $image['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($image['tmp_name'], 'public/assets/img/cars/' . $filename);
			// $filePath = "public/images/cars/" . $filename;
		}
		// dd($filePath);
		$data = compact('name', 'cate_id', 'location_id', 'maker_id', 'user_id', 'price', 'detail');
        $data['feature_image'] = $filename;
		$model = new Car();
		$model->id = $id;
		$model->update($data);
		header('location: ' . ADMIN_URL . '/car/edit?id=' . $id);
	}

	public function delCar($id)
	{
		$id = $_GET['id'];
		$car = Car::destroy($id);
		header('Location: ../car');
	}
	
}

 ?>