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
    // thêm mới
    public function addMaker()
    {
        include_once './app/views/backend/makers/add.php';
    }
    public function saveAddMaker()
    {
        $name = isset($_POST['name']) == true ? $_POST['name'] : "";

        $data = compact('name');
        $model = new Maker;
        $model->insert($data);
        header('Location: ../maker');
    }

    // sửa
    public function editMaker()
    {
        $id = $_GET['id'];
        $maker = Maker::where(['id', '=', $id])->first();
        include_once './app/views/backend/makers/edit.php';
    }
    public function saveEditMaker()
    {
        $id = isset($_POST['id']) == true ? $_POST['id'] : "";
        $name = isset($_POST['name']) == true ? $_POST['name'] : "";
        $data = compact('name');
        $model = new Maker();
        $model = Maker::where(['id', '=', $id])->first();
        $model->update($data);
        header("Location: ../maker/edit?id=$id");
    }

    public function delMaker($id)
    {
        $id = $_GET['id'];
        $maker = Maker::destroy($id);
        header('Location: ../maker');
    }
}

 ?>