<?php

include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Thông tin chi tiết xe</h2>
      <ul>
        <li>
          <a href="#">home</a>
        </li>
        <li>product details </li>
      </ul>
    </div>
  </div>
</div>
<div class="product-details-area fluid-padding-3 ptb-130">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="product-details-content">



          <div class="row">
            <div class="col-md-6">
              <img width="100%" src="assets/img/product/honda-future.png" alt="">
            </div>
            <div class="col-md-6">
              <h2><?= $detail->name ?></h2>
              <?php
              for ($i = 1; $i <= 5; $i++) {
                if ($detail->rating >= $i) {
                  echo "<img width='20px' src='assets/img/icon-img/starFull.png' alt=''>";
                } else if (!is_int($detail->rating)) {
                  echo "<img width='20px' src='assets/img/icon-img/star1.png' alt=''>";
                  if ($i < 5) {
                    for ($j = $i; $j < 5; $j++) {
                      echo "<img width='20px' src='assets/img/icon-img/star0.png' alt=''>";
                    }
                    break;
                  }
                }
              }
              ?>
              <div class="product-price">
                <span>$ <?= $detail->price ?></span>
              </div>
              <br>
              <div class="bundle-area">

                <div class="bundle-all-price">
                  <div class="bundle-price">
                    <ul>
                      <li><?= $detail->getCateName() ?></li>
                      <li><?= $detail->getMakerName() ?></li>
                      <li><?= $detail->getLocaName() ?></li>
                    </ul>
                  </div>
                  <div class="bundle-result">
                    <h4>Price For All : <span> <span class="bundle-cross"> $1300</span> -
                        $750</span></h4>
                  </div>
                </div>

              </div>
            </div>
          </div>



          <div class="product-overview">
            <h5 class="pd-sub-title">Thông tin chi tiết về xe</h5>
            <p><?= $detail->detail ?></p>
          </div>

        </div>
      </div>
      <div class="col-lg-4">
        <div class="product-details-content">

          <div>
            <form>
              <div class="form-group">
                <button class="btn-lg btn-warning btn-block " type="submit">ĐẶT XE</button>
              </div>
              <div class="form-group">
                <label for="">Chọn địa điểm nhận xe</label>
                <select class="form-control">
                  <option value="" hidden="">Chọn điểm nhận xe</option>
                  <option value="1">Hà Nội</option>
                  <option value="2">TP. Hồ Chí Minh</option>
                  <option value="3">Đà Nẵng</option>
                  <option value="4">Phú Quốc</option>
                  <option value="7">Sapa (Lào Cai)</option>
                  <option value="11">Ninh Bình</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Ngày nhận xe</label>
                <input type="text" id="timeCheckIn" class="form-control" name="start_time" value="" />
              </div>
              <div class="form-group">
                <label for="">Ngày trả xe</label>
                <input class="form-control" type="date">
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
</div>
<?php
include_once "./app/views/client/template/footer.php";
?>