<?php 
namespace App\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Location;

use App\Models\Makers;

use App\Models\Maker;
use App\Models\Order;
use App\Models\User;
use App\Models\Role;
use App\Models\OrderDetail;


class PartnerController{
    public function homePagePartner(){
        include_once './app/views/partner/homepage/home.php';
    }
    public function listCarsPartner(){
        $user_id = $_SESSION['AUTH']['id'];
        // var_dump($user_id);die;
        $carsPartner = Car::where(['user_id', '=', $user_id])->get();
        
        include_once './app/views/partner/cars/list.php';
    }
    public function addCarsPartner(){
        $categories = Category::all();
		$locations = Location::all();
		$makers = Makers::all();
		$makers = Maker::all();
        include_once './app/views/partner/cars/add.php';
    }
    public function saveAddCarsPartner(){
        $name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$cate_id = isset($_POST['cate_id']) == true ? $_POST['cate_id'] : "";
		$location_id = isset($_POST['location_id']) == true ? $_POST['location_id'] : "";
		$maker_id = isset($_POST['maker_id']) == true ? $_POST['maker_id'] : "";
		$price = isset($_POST['price']) == true ? $_POST['price'] : "";
		$detail = isset($_POST['detail']) == true ? $_POST['detail'] : "";

		$image = $_FILES['feature_image'];
		$filePath = "";
		if ($image['size'] > 0) {
			$filename = $image['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($image['tmp_name'], 'public/assets/img/cars/' . $filename);
			// $filePath = "public/images/cars/" . $filename;
		}
		// dd($filePath);
		$data = compact('name', 'cate_id', 'location_id', 'maker_id', 'price', 'detail');
        $data['feature_image'] = $filename;
        $data['user_id'] =  $user_id = $_SESSION['AUTH']['id'];
		$model = new Car();
		$model->insert($data);
		header('location: ' . PARTNER_URL . '/cars');
    }

    public function editCarsPartner(){
        $user_id = $_SESSION['AUTH']['id'];
        $categories = Category::all();
		$locations = Location::all();
		$makers = Makers::all();
		$makers = Maker::all();
		
		$id = isset($_GET['id']) ? $_GET['id'] : null;
        $car = Car::where(['id','=',$id])->andWhere(['user_id', '=', $user_id])->first();
        // var_dump($car);
		if(!$car){
			header('location: ../cars');
        	die;
		}
		include_once './app/views/partner/cars/edit.php';
    }
    public function saveEditCarsPartner(){
		$id = isset($_POST['id']) == true ? $_POST['id'] : "";
		$user_id = isset($_POST['user_id']) == true ? $_POST['user_id'] : "";
		$name = isset($_POST['name']) == true ? $_POST['name'] : "";
		$cate_id = isset($_POST['cate_id']) == true ? $_POST['cate_id'] : "";
		$location_id = isset($_POST['location_id']) == true ? $_POST['location_id'] : "";
		$maker_id = isset($_POST['maker_id']) == true ? $_POST['maker_id'] : "";
		$price = isset($_POST['price']) == true ? $_POST['price'] : "";
		$detail = isset($_POST['detail']) == true ? $_POST['detail'] : "";

		$image = $_FILES['feature_image'];
		$filePath = "";
		if ($image['size'] > 0) {
			$filename = $image['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($image['tmp_name'], 'public/assets/img/cars/' . $filename);
			// $filePath = "public/images/cars/" . $filename;
		}
		// dd($filePath);
		$data = compact('name', 'cate_id', 'location_id', 'maker_id', 'price', 'detail');
        $data['feature_image'] = $filename;
        $data['user_id'] =  $user_id = $_SESSION['AUTH']['id'];
		$data = compact('name', 'cate_id', 'location_id', 'maker_id', 'user_id', 'price', 'detail');
        $data['feature_image'] = $filename;
		$model = new Car();
		$model->id = $id;
		$model->update($data);
		header('location: ' . PARTNER_URL . '/cars');

	}
	
	public function informationAccount(){
		$user_id = $_SESSION['AUTH']['id'];
	
		$user = User::where(['id', '=', $user_id])->first();
		// var_dump($user);die;
		include_once './app/views/partner/users/list.php';
	}

	public function editAccount(){
		$id = $_SESSION['AUTH']['id'];
		$roles = Role::all();

		$user = User::where(['id', '=', $id])->first();
		include_once './app/views/partner/users/edit.php';
	}

	public function saveEditAccount(){
		$id = isset($_POST['id']) == true ? $_POST['id']: "";
		$name = isset($_POST['name']) == true ? $_POST['name']: "";
		$email = isset($_POST['email']) == true ? $_POST['email']: "";
		$password = isset($_POST['password']) == true ? $_POST['password']: "";
		$role_id = isset($_POST['role_id']) == true ? $_POST['role_id']: "";
		$status = isset($_POST['status']) == true ? $_POST['status']: "";

		$avatar = isset($_FILES['avatar']) == true ? $_FILES['avatar']: "";

		if ($avatar['size'] > 0) {
			$filename = $avatar['name'];
			$filename = uniqid() . "-" . $filename;
			move_uploaded_file($avatar['tmp_name'], 'public/assets/img/users/' . $filename);
		}
		// mã hóa mật khẩu
		$hashpassword = password_hash($password, PASSWORD_DEFAULT);
		$data = compact('name', 'email', 'role_id', 'status');
		$data['password'] = $hashpassword;
		$data['avatar'] = $filename;
		$data['updated_at'] = date_format(date_create(), 'Y-m-d H:i:s');
		// var_dump($data);die;
		$model = new User();
		$model->id = $id;
		$model->update($data);

		header('location: ' . PARTNER_URL . '/account');
	}


	public function listOrdersPartner(){
		$user_id = $_SESSION['AUTH']['id'];
		$orderOfPartner = OrderDetail::rawQuery('SELECT *
											FROM order_detail
											INNER JOIN cars ON order_detail.car_id = cars.id
											INNER JOIN orders ON order_detail.order_id = orders.id
											WHERE cars.user_id = ' . $user_id)
											->get();
		// var_dump($orderOfPartner);die;
		include_once './app/views/partner/orders/list.php';
	}

	public function editOrdersPartner(){
		$user_id = $_SESSION['AUTH']['id'];
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$order = Order::where(['id', '=', $id])->first();
		if(!$order){
			header('location: ' . PARTNER_URL);
        	die;
		}
		if($order != ""){
			$orderDetail = OrderDetail::where(['order_id','=', $order->id])->get();
		}
		include_once './app/views/partner/orders/edit.php';
	}
	

}
?>