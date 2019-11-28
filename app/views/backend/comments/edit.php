<?php
require_once './app/views/backend/master/master.php';
require_once './app/views/backend/master/header.php';
require_once './app/views/backend/master/sidebar.php';
?>
<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="page-header">
        <h4 class="page-title">Danh mục</h4>
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
            <a href="<?= ADMIN_URL . '/comment' ?>">Danh mục</a>
          </li>
        </ul>
      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex align-items-center">

                <a href="<?= ADMIN_URL . '/comment' ?>" class="btn btn-primary btn-round ml-auto">
                  Danh sách
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="row justify-content-md-center">
                <div class="col-md-8">
                  <form action="<?= ADMIN_URL . '/comment/save-edit' ?>" method="post">
                    <input type="hidden" name="id" value="<?= $comment->id ?>">
                    <div class="form-group">
                      <label>Tên khách hàng:</label>
                      <input type="text" name="name" class="form-control" placeholder="Tên danh mục" value="<?= $comment->getUserName() ?>">
                      <!-- <small id="emailHelp2" class="form-text text-muted">Validate</small> -->
                    </div>
                    <div class="form-group">
                      <label for="comment">Tên xe</label>
                      <input type="text" name="name" class="form-control" placeholder="Tên danh mục" value="<?= $comment->getCarName() ?>">
                      <textarea name="description" class="form-control" id="comment" rows="5"><?= $comment->getCarName() ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="comment">Tên đề</label>
                      <input type="text" name="name" class="form-control" placeholder="Tên danh mục" value="<?= $comment->title ?>">
                    </div>
                    <div class="form-group">
                      <label for="comment">Tên xe</label>
                      <textarea name="description" class="form-control" id="comment" rows="5"><?= $comment->content ?></textarea>
                    </div>
                    <div class="form-check">
                      <label>Hiển thị bình luận</label><br>
                      <label class="form-radio-label">
                        <input class="form-radio-input" type="radio" name="show_menu" value="2" <?php
                                                                                                if ($comment->status == 2) {
                                                                                                  echo 'checked';
                                                                                                } ?>>
                        <span class="form-radio-sign">Không</span>
                      </label>
                      <label class="form-radio-label ml-3">
                        <input class="form-radio-input" type="radio" name="show_menu" value="1" <?php
                                                                                                if ($comment->status == 1) {
                                                                                                  echo 'checked';
                                                                                                } ?>>
                        <span class="form-radio-sign">Có</span>
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

<!-- End Custom template -->
<?php

require_once './app/views/backend/master/footer.php';
?>