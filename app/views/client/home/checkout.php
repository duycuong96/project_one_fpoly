<?php
include_once "./app/views/client/template/header.php";
?>
<div class="breadcrumb-area pt-255 pb-170" style="background-image: url(assets/img/banner/banner-4.jpg)">
  <div class="container-fluid">
    <div class="breadcrumb-content text-center">
      <h2>checkout page</h2>
      <ul>
        <li>
          <a href="#">home</a>
        </li>
        <li>checkout page</li>
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
          <h2>tên car</h2>
          <img width="100%" src="assets/img/product/honda-future.png" alt="">
          <div class="product-overview">
            <h5 class="pd-sub-title">Địa điểm nhận xe</h5>
            <p>Hà Nội</p>
          </div>
          <div class="product-overview">
            <h5 class="pd-sub-title">Thời gian nhận xe</h5>
            <p>2019</p>
          </div>
          <div class="product-overview">
            <h5 class="pd-sub-title">Thời gian trả xe</h5>
            <p>Hà Nội</p>
          </div>
          <div class="product-overview">
            <h5 class="pd-sub-title">Chi tiết giá</h5>
            <table class="table">
              <tr>
                <td>Đơn giá ngày</td>
                <td>100,000 đ</td>
              </tr>
              <tr>
                <td>Ngày</td>
                <td>2 ngày</td>
              </tr>
              <tr>
                <td><b>Tổng</b></td>
                <td>200,000 đ</td>
              </tr>
            </table>
          </div>
        </div>

      </div>
      <div class="col-md-8">
        <div class="product-details-content">
          <form action="#">
            <div class="checkbox-form">
              <h3>Billing Details</h3>
              <div class="row">
                <div class="col-md-12">
                  <div class="country-select">
                    <label>Country <span class="required">*</span></label>
                    <select>
                      <option value="volvo">bangladesh</option>
                      <option value="saab">Algeria</option>
                      <option value="mercedes">Afghanistan</option>
                      <option value="audi">Ghana</option>
                      <option value="audi2">Albania</option>
                      <option value="audi3">Bahrain</option>
                      <option value="audi4">Colombia</option>
                      <option value="audi5">Dominican Republic</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>First Name <span class="required">*</span></label>
                    <input type="text" placeholder="" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>Last Name <span class="required">*</span></label>
                    <input type="text" placeholder="" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Company Name</label>
                    <input type="text" placeholder="" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Address <span class="required">*</span></label>
                    <input type="text" placeholder="Street address" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <input type="text" placeholder="Apartment, suite, unit etc. (optional)" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Town / City <span class="required">*</span></label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>State / County <span class="required">*</span></label>
                    <input type="text" placeholder="" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>Postcode / Zip <span class="required">*</span></label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>Email Address <span class="required">*</span></label>
                    <input type="email" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>Phone <span class="required">*</span></label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list create-acc">
                    <input id="cbox" type="checkbox" />
                    <label>Create an account?</label>
                  </div>
                  <div id="cbox_info" class="checkout-form-list create-account">
                    <p>Create an account by entering the information below. If you are a
                      returning customer please login at the top of the page.</p>
                    <label>Account password <span class="required">*</span></label>
                    <input type="password" placeholder="password" />
                  </div>
                </div>
              </div>
              <div class="different-address">
                <div class="ship-different-title">
                  <h3>
                    <label>Ship to a different address?</label>
                    <input id="ship-box" type="checkbox" />
                  </h3>
                </div>
                <div id="ship-box-info" class="row">
                  <div class="col-md-12">
                    <div class="country-select">
                      <label>Country <span class="required">*</span></label>
                      <select>
                        <option value="volvo">bangladesh</option>
                        <option value="saab">Algeria</option>
                        <option value="mercedes">Afghanistan</option>
                        <option value="audi">Ghana</option>
                        <option value="audi2">Albania</option>
                        <option value="audi3">Bahrain</option>
                        <option value="audi4">Colombia</option>
                        <option value="audi5">Dominican Republic</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="checkout-form-list">
                      <label>First Name <span class="required">*</span></label>
                      <input type="text" placeholder="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="checkout-form-list">
                      <label>Last Name <span class="required">*</span></label>
                      <input type="text" placeholder="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="checkout-form-list">
                      <label>Company Name</label>
                      <input type="text" placeholder="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="checkout-form-list">
                      <label>Address <span class="required">*</span></label>
                      <input type="text" placeholder="Street address" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="checkout-form-list">
                      <input type="text" placeholder="Apartment, suite, unit etc. (optional)" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="checkout-form-list">
                      <label>Town / City <span class="required">*</span></label>
                      <input type="text" placeholder="Town / City" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="checkout-form-list">
                      <label>State / County <span class="required">*</span></label>
                      <input type="text" placeholder="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="checkout-form-list">
                      <label>Postcode / Zip <span class="required">*</span></label>
                      <input type="text" placeholder="Postcode / Zip" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="checkout-form-list">
                      <label>Email Address <span class="required">*</span></label>
                      <input type="email" placeholder="" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="checkout-form-list">
                      <label>Phone <span class="required">*</span></label>
                      <input type="text" placeholder="Postcode / Zip" />
                    </div>
                  </div>
                </div>
                <div class="order-notes">
                  <div class="checkout-form-list mrg-nn">
                    <label>Order Notes</label>
                    <textarea id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
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
<?php
include_once "./app/views/client/template/footer.php";
?>