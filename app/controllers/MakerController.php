<?php 
namespace App\Controllers;


use App\Models\Maker;


class MakerController
{
	
	// list
	public function listMaker(){
        $makers = Maker::all();
        include_once './app/views/backend/makers/list.php';
    }
}

 ?>