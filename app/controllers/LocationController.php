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

		if (isset($_SERVER['PHP_SELF'])){
			// tên
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên địa điểm";
			}
			// mô tả
			$err_description = "";
			if($err_description == ""){
				$err_description = "Vui lòng nhập mô tả";
			}
			// ảnh
			$err_file = "";

			$allowed_image_extension = array(
				"png",
				"jpg",
				"jpeg"
			);
		
			// pathinfo trả về thông tin về đường dẫn tệp
			$file_extension = pathinfo($image["name"], PATHINFO_EXTENSION);
		
			//  Kiểm tra xem một tập tin hoặc thư mục tồn tại
			if (!file_exists($image["tmp_name"])) {
				$err_file = "Vui lòng chọn hình ảnh để tải lên";
			}
			//  Kiểm tra biến tồn tại trong mảng
			else if (!in_array($file_extension, $allowed_image_extension)) {
				$err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
			}
			// move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
			// upload ảnh
			else {
								// $filePath = "";
				if ($image['size'] > 0) {
					$filename = $image['name'];
					$filename = uniqid() . "-" . $filename;
					move_uploaded_file($image['tmp_name'], 'public/assets/img/locations/' . $filename);
					// $filePath = "public/images/cars/" . $filename;
				}
			}
			
		// kiểm tra và hiện validation
		if($err_name != "" || $err_description != "" || $err_file != ""){
			header(
				'location: ' . ADMIN_URL . '/location/add?'
					. 'err_name=' . $err_name
					. '&err_description=' . $err_description
					. '&err_file=' . $err_file
			);
			die;
		}
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

		if (isset($_SERVER['PHP_SELF'])){
			// tên
			$err_name = "";
			if($name == ""){
				$err_name = "Vui lòng nhập tên địa điểm";
			}
			// mô tả
			$err_description = "";
			if($err_description == ""){
				$err_description = "Vui lòng nhập mô tả";
			}
			// ảnh
			$err_file = "";

			$allowed_image_extension = array(
				"png",
				"jpg",
				"jpeg"
			);
		
			// pathinfo trả về thông tin về đường dẫn tệp
			$file_extension = pathinfo($image["name"], PATHINFO_EXTENSION);
		
			//  Kiểm tra xem một tập tin hoặc thư mục tồn tại
			if (!file_exists($image["tmp_name"])) {
				$err_file = "Vui lòng chọn hình ảnh để tải lên";
			}
			//  Kiểm tra biến tồn tại trong mảng
			else if (!in_array($file_extension, $allowed_image_extension)) {
				$err_file = "Tải lên hình ảnh khác. Chỉ cho phép JPG, PNG và JPEG.";
			}
			// move_uploaded_file Di chuyển tệp đã tải lên đến một vị trí mới
			// upload ảnh
			else {
								// $filePath = "";
				if ($image['size'] > 0) {
					$filename = $image['name'];
					$filename = uniqid() . "-" . $filename;
					move_uploaded_file($image['tmp_name'], 'public/assets/img/locations/' . $filename);
					// $filePath = "public/images/cars/" . $filename;
				}
			}
			
		// kiểm tra và hiện validation
		if($err_name != "" || $err_description != "" || $err_file != ""){
			header(
				'location: ' . ADMIN_URL . '/location/edit?id=' . $id
					. '&err_name=' . $err_name
					. '&err_description=' . $err_description
					. '&err_file=' . $err_file
			);
			die;
		}
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