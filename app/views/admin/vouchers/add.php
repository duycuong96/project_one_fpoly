<?php
require_once './app/views/backend/master/master.php';
?>

<body>
    <div class="wrapper">
        <?php
        require_once './app/views/backend/master/header.php';
        ?>

        <!-- Sidebar -->
        <?php
        require_once './app/views/backend/master/sidebar.php';
        ?>
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Voucher</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ADMIN_URL . '/category' ?>">Voucher</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">

                                        <a href="<?= ADMIN_URL . '/voucher' ?>" class="btn btn-primary btn-round ml-auto">
                                            Danh sách
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-8">
                                            <form action="<?= ADMIN_URL . '/voucher/save-add' ?>" method="post">

                                                <div class="form-group">
                                                    <label>Mã voucher:</label>
                                                    <input type="text" class="form-control" placeholder="" value="" name="code" >
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Thời gian bắt đầu:</label>
                                                  
                                                    <input type="text" id="timeCheckIn"  name="start_time" class="form-control" value="" />
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Thời gian kết thúc:</label>
                                                    <input type="text" id="timeCheckOut" name="end_time" class="form-control" value="" />
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Giảm giá:</label>
                                                    <input type="text" class="form-control" placeholder="Nhập tiền giảm giá" name="discount_price" value="">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-check">
                                                    <label>Trạng thái:</label><br>
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="status" value="0" checked="">
                                                        <span class="form-radio-sign">Chưa kích hoạt</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="status" value="1">
                                                        <span class="form-radio-sign">Kích hoạt</span>
                                                    </label>
                                                </div>

                                                <div class="card-action">
                                                    <button class="btn btn-success">Cập nhật</button>
                                                    <button class="btn btn-danger">Trở lại</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>


        <!-- End Custom template -->
        <?php
        require_once './app/views/backend/master/footer.php';
        ?>