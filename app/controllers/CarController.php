<?php 
namespace App\Controllers;


use App\Models\Car;

class CarController
{
	
	// list
	public function listCar(){	
		$cars = Car::all();
		
		include_once './app/views/backend/cars/list.php';
	}
	// add
	public function addCar(){
		include_once './app/views/backend/cars/add.php';
	}
	// edit
	public function editCar(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$car = Car::where(['id','=',$id])->first();
		if(!$car){
			header('location: ' . ADMIN_URL);
        	die;
		}
		include_once './app/views/backend/cars/edit.php';
	}
	
}

 ?>