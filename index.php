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
use App\Controllers\CommentController;
use App\Controllers\HomeController;
use App\Controllers\LocationController;
use App\Controllers\MakerController;
use App\Controllers\UserController;
use App\Controllers\VoucherController;
use App\Controllers\OrderController;
use App\Controllers\PageController;
use App\Controllers\WebSettingController;
use App\Controllers\RoleController;
use App\Models\User;

switch ($url) {
	// trang chủ
	case '/':
		$ctr = new HomeController();
		$ctr->index();
		break;
		// trang danh mục
	case 'category':
		$ctr = new HomeController();
		$ctr->category();
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
	case 'admin/category/save-add':
		$ctr = new CategoryController();
		$ctr->saveAddCategory();
		break;
	case 'admin/category/edit':
		$ctr = new CategoryController();
		$ctr->editCategory();
		break;
	case 'admin/category/save-edit':
		$ctr = new CategoryController();
		$ctr->editSaveCategory();
		break;
	case 'admin/category/del':
		$id = $_GET['id'];
		$ctr = new CategoryController();
		$ctr->delCategory($id);
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
	case 'admin/location/save-add':
		$ctr = new LocationController();
		$ctr->saveAddLocation();
		break;
	case 'admin/location/edit':
		$ctr = new LocationController();
		$ctr->editLocation();
		break;
	case 'admin/location/save-edit':
		$ctr = new LocationController();
		$ctr->saveEditLocation();
		break;
	case 'admin/location/del':
		$ctr = new LocationController();
		$ctr->delLocation($id);
		break;
	// maker (hãng xe)
	case 'admin/maker':
		$ctr = new MakerController();
		$ctr->listMaker();
		break;
	case 'admin/maker/add':
		$ctr = new MakerController();
		$ctr->addMaker();
		break;
	case 'admin/maker/save-add':
		$ctr = new MakerController();
		$ctr->saveAddMaker();
		break;
	case 'admin/maker/edit':
		$ctr = new MakerController();
		$ctr->editMaker();
		break;
	case 'admin/maker/save-edit':
		$ctr = new MakerController();
		$ctr->saveEditMaker();
		break;
	case 'admin/maker/del':
		$ctr = new MakerController();
		$ctr->delMaker($id);
		break;
	// xe
	case 'admin/car':
		$ctr = new CarController();
		$ctr->listCar();
		break;
	case 'admin/car/add':
		$ctr = new CarController();
		$ctr->addCar();
		break;
	case 'admin/car/save-add':
		$ctr = new CarController();
		$ctr->saveAddCar();
		break;
	case 'admin/car/edit':
		$ctr = new CarController();
		$ctr->editCar();
		break;
	case 'admin/car/save-edit':
		$ctr = new CarController();
		$ctr->saveEditCar();
		break;
	case 'admin/car/del':
		$ctr = new CarController();
		$ctr->delCar($id);
		break;

	// tài khoản
	case 'admin/account':
		$ctr = new UserController();
		$ctr->listUser();
		break;
	case 'admin/account/add':
		$ctr = new UserController();
		$ctr->addUser();
		break;
	case 'admin/account/save-add':
		$ctr = new UserController();
		$ctr->saveAddUser();
		break;
	case 'admin/account/edit':
		$ctr = new UserController();
		$ctr->editUser();
		break;
	case 'admin/account/save-edit':
		$ctr = new UserController();
		$ctr->saveEditUser();
		break;
	case 'admin/account/del':
		$ctr = new UserController();
		$ctr->delUser($id);
		break;
	// vai trò
	case 'admin/role':
		$ctr = new RoleController();
		$ctr->listRole();
		break;
	case 'admin/role/add':
		$ctr = new RoleController();
		$ctr->addRole();
		break;
	case 'admin/role/save-add':
		$ctr = new RoleController();
		$ctr->saveAddRole();
		break;
	case 'admin/role/edit':
		$ctr = new RoleController();
		$ctr->editRole();
		break;
	case 'admin/role/save-edit':
		$ctr = new RoleController();
		$ctr->saveEditRole();
		break;
	// bình luận
	case 'admin/comment':
		$ctr = new CommentController();
		$ctr->listComment();
		break;
	case 'admin/comment/edit':
		$ctr = new CommentController();
		$ctr->editComment();
		break;
	case 'admin/comment/save-edit':
		$ctr = new CommentController();
		$ctr->editSaveComment();
		break;
	// mã giảm giá voucher
	case 'admin/voucher':
		$ctr = new VoucherController();
		$ctr->listVoucher();
		break;
	case 'admin/voucher/add':
		$ctr = new VoucherController();
		$ctr->addVoucher();
		break;
	case 'admin/voucher/save-add':
		$ctr = new VoucherController();
		$ctr->SaveAddVoucher();
		break;
	case 'admin/voucher/edit':
		$ctr = new VoucherController();
		$ctr->editVoucher();
		break;
	// đơn hàng
	case 'admin/order':
		$ctr = new OrderController();
		$ctr->listOrder();
		break;
	case 'admin/order/edit':
		$ctr = new OrderController();
		$ctr->editOrder();
		break;
	// page
	case 'admin/page':
		$ctr = new PageController();
		$ctr->listPage();
		break;
	case 'admin/page/add':
		$ctr = new PageController();
		$ctr->addPage();
	break;
	case 'admin/page/save-add':
		$ctr = new PageController();
		$ctr->saveAddPage();
		break;
	case 'admin/page/edit':
		$ctr = new PageController();
		$ctr->editPage();
	break;
	case 'admin/page/save-edit':
		$ctr = new PageController();
		$ctr->SaveEditPage();
		break;
	case 'admin/page/del':
		$ctr = new PageController();
		$ctr->delPage($id);
		break;
	// cấu hình website
	case 'admin/setting':
		$ctr = new WebSettingController();
		$ctr->listWebSetting();
		break;
	case 'admin/setting/add':
		$ctr = new WebSettingController();
		$ctr->addWebSetting();
		break;
	case 'admin/setting/save-add':
		$ctr = new WebSettingController();
		$ctr->SaveAddWebSetting();
		break;
	case 'admin/setting/edit':
		$ctr = new WebSettingController();
		$ctr->editWebSetting();
		break;
	case 'admin/setting/save-edit':
		$ctr = new WebSettingController();
		$ctr->saveEditWebSetting();
		break;
	case 'admin/setting/del':
		$id = $_GET['id'];
		$ctr = new WebSettingController();
		$ctr->delWebSetting($id);
		break;

		# code...
		break;
}


 ?>