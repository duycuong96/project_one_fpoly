<?php 
namespace App\Controllers;


use App\Models\Location;


class LocationController
{
	
	// list
	public function listLocation(){	
		$locations = Location::all();
		include_once './app/views/backend/locations/list.php';
	}
	// thêm mới
	public function addLocation(){
		include_once './app/views/backend/locations/add.php';
	}
	
	// sửa
	public function editLocation(){
		$id = $_GET['id'];
		$location = Location::where(['id','=',$id])->first();
		include_once './app/views/backend/locations/edit.php';
	}
}

 ?>