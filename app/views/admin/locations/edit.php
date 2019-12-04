<?php
require_once './app/views/admin/master/master.php';
require_once './app/views/admin/master/header.php';
require_once './app/views/admin/master/sidebar.php';
?>
<div class="main-panel">
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">Địa điểm</h4>
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
                        <a href="<?= ADMIN_URL . '/location' ?>">Địa điểm</a>
                    </li>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">

                                <a href="<?= ADMIN_URL . '/location' ?>" class="btn btn-primary btn-round ml-auto">
                                    Danh sách
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-md-center">
                                <div class="col-md-8">
                                    <form action="<?= ADMIN_URL . '/location/save-edit' ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?= $location->id ?>">
                                        <div class="form-group">
                                            <label>Tên:</label>
                                            <input type="text" name="name" class="form-control" placeholder="Tên danh mục" value="<?= $location->name ?>">
                                            <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                        </div>
                                        <div class="form-group">
                                            <label>Ảnh:</label>
                                            <input type="hidden" name="image" class="form-control" value="<?= $location->image ?>">
                                            <img height="100px" src="<?= $location->image ?>" alt="">
                                            <input type="file" name="images" id="">
                                            <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                                        </div>
                                        <div class="form-check">
                                            <label>Hiển thị bình luận</label><br>
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="show_location" value="2" <?php
                                                                                                                        if ($location->show_location == 2) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                                <span class="form-radio-sign">Không</span>
                                            </label>
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="show_location" value="1" <?php
                                                                                                                        if ($location->show_location == 1) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                                                <span class="form-radio-sign">Có</span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Mô tả:</label>
                                            <textarea class="form-control" name="description" id="comment" rows="5"><?= $location->description ?></textarea>
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

<!-- End Custom template -->
<?php
require_once './app/views/admin/master/footer.php';
?>