<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <base href="<?= ADMIN_URL ?>">
    <title>Danh mục</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="./public/assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="./public/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['./public/assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="./public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/assets/css/atlantis.min.css">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <!-- <link rel="stylesheet" href="./public/assets/css/demo.css"> -->
    <link href="https://thichchiase.com/demo/date-range-picker/Date%20range%20picker%20sample_files/datepicker.css" rel="stylesheet" />

</head>

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
                                            <form action="<?= ADMIN_URL . '/voucher/save-add'  ?>" method="post">
                                                <div class="form-group">
                                                    <label>Mã voucher:</label>
                                                    <input type="text" name="code" class="form-control" placeholder="" value="">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Thời gian bắt đầu:</label>
                                                    <input type="date" name="start_time" class="form-control" placeholder="" value="">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Thời gian kết thúc:</label>
                                                    <input type="date" name="end_time" class="form-control" placeholder="" value="">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Giảm giá:</label>
                                                    <input type="text" name="discount_price" class="form-control" placeholder="Nhập tiền giảm giá" value="">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-group">
                                                    <label>Số lượng mã</label>
                                                    <input type="text" name="used_count" class="form-control" placeholder="Nhập số lượng mã giảm giá" value="">
                                                    <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                                </div>
                                                <div class="form-check">
                                                    <label>Trạng thái:</label><br>
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="status" value="2" checked="">
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
                                                <div class="container" style="padding-top:20px">
                                                    <div class="row">
                                                        <div class="col-md-8 col-md-offset-2">
                                                            <div class="panel panel-primary">
                                                                <div class="panel-heading">
                                                                    Date range picker sample
                                                                </div>
                                                                <div class="panel-body">
                                                                    <table class="table">
                                                                        <tr>
                                                                            <td>Check In:</td>
                                                                            <td>
                                                                                <input type="text" id="timeCheckIn" class="form-control" />
                                                                            </td>
                                                                            <td>Check Out:</td>
                                                                            <td>
                                                                                <input type="text" id="timeCheckOut" class="form-control" />
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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

        <!-- End Custom template -->
        <!-- footer -->
        <script>
            function del() {
                return confirm('Bạn có muốn xóa không ?');
            }
        </script>


        <!--   Core JS Files   -->
        <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
        <script src="./public/assets/js/core/popper.min.js"></script>
        <script src="./public/assets/js/core/bootstrap.min.js"></script>
        <!-- jQuery UI -->
        <script src="./public/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script src="./public/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

        <!-- jQuery Scrollbar -->
        <script src="./public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
        <!-- Datatables -->
        <script src="./public/assets/js/plugin/datatables/datatables.min.js"></script>
        <!-- Atlantis JS -->
        <script src="./public/assets/js/atlantis.min.js"></script>
        <!-- Atlantis DEMO methods, don't include it in your project! -->
        <script src="./public/assets/js/setting-demo2.js"></script>
        <!--  -->

        <script src="./public/assets/js/bootstrap-datepicker.js"></script>

        <script src="https://thichchiase.com/demo/date-range-picker/Date%20range%20picker%20sample_files/bootstrap-datepicker.js"></script>
        <!-- end footer -->
        <script>
            $(function() {
                'use strict';
                var nowTemp = new Date();
                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

                var checkin = $('#timeCheckIn').datepicker({
                    onRender: function(date) {
                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function(ev) {
                    if (ev.date.valueOf() > checkout.date.valueOf()) {
                        var newDate = new Date(ev.date)
                        newDate.setDate(newDate.getDate() + 1);
                        checkout.setValue(newDate);
                    }
                    checkin.hide();
                    $('#timeCheckOut')[0].focus();
                }).data('datepicker');
                var checkout = $('#timeCheckOut').datepicker({
                    onRender: function(date) {
                        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                    }
                }).on('changeDate', function(ev) {
                    checkout.hide();
                }).data('datepicker');
            });
        </script>


</body>

</html>