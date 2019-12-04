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
		$description = isset($_POST['description']) == true ? $_POST['description'] : "";

		$data = compact('name', 'description');
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
		$description = isset($_POST['description']) == true ? $_POST['description'] : "";
		$data = compact('name', 'description');
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