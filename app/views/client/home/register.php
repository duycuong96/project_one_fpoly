<?php
include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Đăng ký</h2>
      <ul>
        <li>
          <a href="#">home</a>
        </li>
        <li>Đăng ký</li>
      </ul>
    </div>
  </div>
</div>
<div class="login-register-area ptb-130">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 ml-auto mr-auto">
        <div class="login-register-wrapper">
          <div class="login-register-tab-list nav">
            <a class="active" data-toggle="tab" href="<?= BASE_URL ?>login">
              <h4 style="color: #fd7e14"> Đăng nhập &nbsp &nbsp &nbsp <a style="color: #303030" href="<?= BASE_URL ?>register">Đăng ký</a></h4>
            </a>
          </div>
          <div class="tab-content">
            <div id="lg1" class="tab-pane active">
              <div class="login-form-container">
                <div class="login-form">
                  <form action="<?= BASE_URL ?>save-register" method="post" enctype="multipart/form-data">
                    <input type="text" name="name" placeholder="Họ và tên">
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Mật khẩu">
                    <input type="password" name="password" placeholder="Nhập lại mật khẩu">
                    <input type="file" name="avatar">
                    <div class="button-box">
                      <button type="submit" class="btn-style cr-btn"><span>Đăng ký</span></button>
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
<?php
include_once "./app/views/client/template/header.php";
?>