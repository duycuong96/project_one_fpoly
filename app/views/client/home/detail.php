<?php

include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>Thông tin chi tiết xe</h2>
      <ul>
        <li>
          <a href="<?= BASE_URL ?>">Trang chủ</a>
        </li>
        <li>Chi tiết xe</li>
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
              <img width="100%" src="<?= IMAGE_URL . $detail->feature_image ?>" alt="">
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

        <h3 style="margin: 40px 0px;">Nhận xét - Đánh giá:</h3>
        <div class="product-details-content">
          <div class="comments">
            <div class="row">
              <div class="col-md-12">
                <form method="post" action="<?= BASE_URL . 'comment' ?>" id="form" role="form" class="blog-comments">
                  <div class="row">

                    <div class="col-md-12 form-group">
                      <!-- Name -->
                      <input type="hidden" name="product_id" value="<?= $detail->id ?>">
                      <input type="text" name="title" id="name" class=" form-control" placeholder="Title *" maxlength="100" required="">
                    </div>

                    <div class="form-group col-md-12">
                      <select class="form-control" name="rating">
                        <option value="">Đánh giá</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                      </select>
                    </div>

                    <!-- Comment -->
                    <div class="form-group col-md-12">
                      <textarea id="text" class=" form-control" rows="6" placeholder="Comment" maxlength="400" name="content"></textarea>
                    </div>

                    <!-- Send Button -->
                    <div class="form-group col-md-12">
                      <button class="btn-lg btn-warning btn-block " type="submit">Gửi</button>
                    </div>


                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>

        <h3 style="margin: 40px 0px;">Khách hàng nhận xét:</h3>
        <div class="product-details-content">
          <div class="comments">
            <div class="row">
              <div class="col-md-2">
                <img style="border-radius: 50%" class="img-comment" src="<?= AVATAR_URL . $_SESSION['AUTH']['avatar'] ?>" alt="">
              </div>
              <div class="col-md-10">
                <div style="margin-left: 20%" class="product-overview">
                  <h5 class="pd-sub-title">Duy Cường</h5>
                  <div class="quick-view-rating">
                    <i class="fa fa-star reting-color"></i>
                    <i class="fa fa-star reting-color"></i>
                    <i class="fa fa-star reting-color"></i>
                    <i class="fa fa-star reting-color"></i>
                    <i class="fa fa-star reting-color"></i>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipic it, sed do eiusmod tempor
                    incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                    exercita
                    tion ullamco laboris nisi ut aliquip ex ea commodo.</p>
                </div>
              </div>
            </div>
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