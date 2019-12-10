<?php
include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Thông tin tài khoản</h2>
      <ul>
        <li>
          <a href="#">home</a>
        </li>
        <li>Thông tin tài khoản</li>
      </ul>
    </div>
  </div>
</div>
<!-- checkout-area start -->
<div class="checkout-area pt-130 pb-100">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="product-details-content">
          <div class="text-center">
            <img style="border-radius:50%;width: 100%; margin-bottom:20px"  src=" <?= AVATAR_URL . $user->avatar ?>" alt="avatar">
            <h4><?= $user->name ?></h4>
          </div>
          <hr>
          <div>
            <p><a href="<?= BASE_URL ?>history">Lịch sử thuê xe</a></p>
            <p><a href="<?= BASE_URL ?>change-password">Đổi mật khẩu</a></p>
            <p><a href="<?= BASE_URL ?>logout">Đăng xuất</a></p>
          </div>
        </div>

      </div>
      <div class="col-md-8">
        <div class="product-details-content">
          <form action="#">
            <div class="checkbox-form">
              <h3>Lịch sử thuê xe</h3>
              <div class="row">
                <?php foreach ($cars as $car ) { ?>
                <div class="history-car">
                  <div class="row">
                    <div class="col-md-5">
                      <img width="280px" src="assets/img/product/honda-air-blade.png" alt="">
                    </div>
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-6">
                          <h4>Honda Air Blade</h4>

                        </div>
                        <div class="col-md-6 text-right">
                          <a href="" class="btn btn-warning">Chi tiết</a>
                        </div>
                        <div class="col-md-12">
                          <p class="text-danger">Trạng thái: Đã thanh toán</p>
                        </div>

                      </div>

                      <hr>
                      <div>
                        <p>Bắt đầu: 9:00 Ngày 20-11-2019 </p>
                        <p>Kết thúc: 9:00 Ngày 21-11-2019 </p>
                        <h5>Tổng tiền: 1,000,000 vnđ</h5>

                      </div>

                    </div>

                  </div>
                </div>
                  
                <?php } ?>


              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>

<?php
include_once "./app/views/client/template/footer.php";
?>