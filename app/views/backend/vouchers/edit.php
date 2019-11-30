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
                                            <form action="">
                                                <input type="hidden" name="id" value="<?= $voucher->id ?>">
                                                <div class="form-group">
                                                    <label>Mã voucher:</label>
                                                    <input type="text" class="form-control" placeholder="" value="<?= $voucher->code ?>">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                                        <label for="aaaaaaaa"></label>
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                                                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Thời gian bắt đầu:</label>
                                                    <input id="datepicker" class="form-control" placeholder="" value="<?= $voucher->start_time ?>">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Thời gian kết thúc:</label>
                                                    <input type="date" class="form-control" placeholder="" value="">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Giảm giá:</label>
                                                    <input type="text" class="form-control" placeholder="Nhập tiền giảm giá" value="<?= $voucher->discount_price ?>">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Số lượng mã</label>
                                                    <input type="text" name="used_count" class="form-control" placeholder="Nhập số lượng mã giảm giá" value="<?= $voucher->used_count ?>">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-check">
                                                    <label>Trạng thái:</label><br>
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="optionsRadios" value="2" checked="">
                                                        <span class="form-radio-sign">Chưa kích hoạt</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="optionsRadios" value="1">
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
        </div>

        <script type="text/javascript">
            $(function() {
                $('#datetimepicker1').datetimepicker({
                    format: 'yyyy-mm-dd hh:ii',
                    format: "yyy-mm-dd",
                    startDate: "2019-11-29",
                    endDate: "2019-11-31"
                });
            });
        </script>
        <!-- End Custom template -->
        <?php
        require_once './app/views/backend/master/footer.php';
        ?>