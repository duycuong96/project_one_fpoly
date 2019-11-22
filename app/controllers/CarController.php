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
	
}

 ?>