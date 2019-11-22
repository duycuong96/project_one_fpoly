<?php



session_start();
// session_destroy();
require_once './commons/utils.php';
require_once './commons/helpers.php';

require_once './vendor/autoload.php';

$url = isset($_GET['url']) ? $_GET['url'] : '/';

use App\Controllers\AdminController;
use App\Controllers\CarController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\LocationController;
use App\Controllers\MakerController;
use App\Controllers\UserController;

switch ($url) {
	// trang chủ
	case '/':
		$ctr = new HomeController();
		$ctr->index();
		break;
	// trang tìm kiếm

	// admin
	case 'admin':
		// checkLogin();
		$ctr = new AdminController();
		$ctr->index();
		break;
	case 'admin/':
		// checkLogin();
		$ctr = new AdminController();
		$ctr->index();
		break;
	case 'admin/login':
		$ctr = new AdminController();
		$ctr->login();
		break;
	case 'admin/post-login':
		$ctr = new AdminController();
		$ctr->postLogin();
		break;
	case 'admin/logout':
		unset($_SESSION['AUTH']);
		header('location: ' . ADMIN_URL);die;
		break;
	case 'admin/forgot':
		$ctr = new AdminController();
		$ctr->forgot();
		break;
	case 'admin/post-forgot':
		$ctr = new AdminController();
		$ctr->postForgot();
		break;
	case 'admin/register':
		$ctr = new AdminController();
		$ctr->register();
		break;
	
	// danh mục xe
	case 'admin/category':
		$ctr = new CategoryController();
		$ctr->listCategory();
		break;
	case 'admin/category/add':
		$ctr = new CategoryController();
		$ctr->addCategory();
		break;
	case 'admin/category/edit':
		$ctr = new CategoryController();
		$ctr->editCategory();
		break;
	// địa điểm cho thuê xe
	case 'admin/location':
		$ctr = new LocationController();
		$ctr->listLocation();
		break;
	case 'admin/location/add':
		$ctr = new LocationController();
		$ctr->addLocation();
		break;
	case 'admin/location/edit':
		$ctr = new LocationController();
		$ctr->editLocation();
		break;
	// maker (hãng xe)
	case 'admin/maker':
		$ctr = new MakerController();
		$ctr->listMaker();
		break;
	// xe
	case 'admin/car':
		$ctr = new CarController();
		$ctr->listCar();
		break;
	
	// tài khoản
	case 'admin/account':
		$ctr = new UserController();
		$ctr->listUser();
		break;
	default:
		# code...
		break;
}


 ?>