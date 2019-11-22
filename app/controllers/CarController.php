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
	
}

 ?>