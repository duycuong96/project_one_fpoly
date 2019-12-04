<?php 
namespace App\Controllers;


use App\Models\Location;


class LocationController
{
	
	// list
	public function listLocation(){	
		$locations = Location::all();
		include_once './app/views/admin/locations/list.php';
	}
	// thêm mới
	public function addLocation(){
		include_once './app/views/admin/locations/add.php';
	}
	public function saveAddLocation()
	{
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$show_location = isset($_POST['show_location']) == true ? $_POST['show_location'] : "";
		$description = isset($_POST['description']) == true ? $_POST['description'] : "";

		$image = $_FILES['image'];
		// dd($image);
		$filePath = "";
		if ($image['size'] > 0) {
			$filename = $image['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($image['tmp_name'], 'public/assets/img/locations/' . $filename);
			// $filePath = "public/images/cars/" . $filename;
		}
		$data = compact('name', 'description', 'show_location');
		$data['image'] = $filename;
		$model = new Location();
		$model->insert($data);
		header('Location: ../location');
	}
	
	// sửa
	public function editLocation(){
		$id = $_GET['id'];
		$location = Location::where(['id','=',$id])->first();
		include_once './app/views/admin/locations/edit.php';
	}
	public function saveEditLocation()
	{
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$image = isset($_POST['image']) == true ? $_POST['image'] : "";
		$show_location = isset($_POST['show_location']) == true ? $_POST['show_location'] : "";
		$description = isset($_POST['description']) == true ? $_POST['description'] : "";

		$images = $_FILES['images'];
		$filePath = "";
		if ($images['size'] > 0) {
			$filename = $images['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($images['tmp_name'], "public/assets/img/locations/" . $filename);
			// $filePath = "./public/images/cars/" . $filename;
		}
		if($images['size'] > 0){
		$data = compact('name', 'description', 'show_location');
		$data['image']=$filename;
		}else {
		$data = compact('name', 'description','image', 'show_location');
		}
		// dd($data);
		$model = new Location();
		$model = Location::where(['id', '=', $id])->first();
		$model->update($data);
		header("Location: ../location/edit?id=$id");
	}

	public function delLocation($id)
	{
		$id = $_GET['id'];
		$loca = Location::destroy($id);
		header('Location: ../location');
	}
}

 ?>