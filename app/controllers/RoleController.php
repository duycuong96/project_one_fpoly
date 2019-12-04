<?php 
namespace App\Controllers;


use App\Models\Role;

class RoleController
{
	
	// list
	public function listRole(){	
		$roles = Role::all();
		include_once './app/views/backend/roles/list.php';
	}
	// thêm mới
	public function addRole(){
		include_once './app/views/backend/roles/add.php';
    }
    public function saveAddRole(){
        $name = isset($_POST['name']) == true ? $_POST['name']: "";
        $status = isset($_POST['status']) == true ? $_POST['status']: "";

        $data = compact('name', 'status');
        $model = new Role();
        $model->insert($data);

        header('location: ' . ADMIN_URL . '/role' );
    }
	// sửa
	public function editRole(){
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$role = Role::where(['id', '=', $id])->first();
		if(!$role){
			header('location: ' . ADMIN_URL);
        	die;
		}
		include_once './app/views/backend/roles/edit.php';
    }
    public function saveEditRole(){
        $id = isset($_POST['id']) == true ? $_POST['id']: "";
        $name = isset($_POST['name']) == true ? $_POST['name']: "";
        $status = isset($_POST['status']) == true ? $_POST['status']: "";

        $data = compact('name', 'status');
        $model = new Role();
        $model->id = $id;
        $model->update($data);

        header('location: ' . ADMIN_URL . '/role' );
    }
    // xóa
    public function delRole($id){
        $id = isset($_GET['id']) ? $_GET['id'] : null;
		$role = Role::destroy($id);
		header('location: ' . ADMIN_URL . '/role');
    }
	
}

 ?>