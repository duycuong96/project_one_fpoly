<?php
require_once './app/views/backend/master/master.php';
require_once './app/views/backend/master/header.php';
require_once './app/views/backend/master/sidebar.php';
?>
<div class="main-panel">
  <div class="content">
    <div class="page-inner">
      <div class="page-header">
        <h4 class="page-title">Xe</h4>
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
            <a href="<?= ADMIN_URL . '/ordersgory' ?>">Xe</a>
          </li>
        </ul>
      </div>
      <div class="row">

        <div class="col-md-12">
          <div class="ordersd">
            <div class="ordersd-header">
              <div class="d-flex align-items-center">

                <a href="<?= ADMIN_URL . '/orders/add' ?>" class="btn btn-primary btn-round ml-auto">
                  <i class="fa fa-plus"></i>
                  Thêm mới
                </a>
              </div>
            </div>
            <div class="card-body">


              <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tên khách hàng</th>
                      <th>Số điện thoại</th>
                      <th>Email</th>
                      <th>Địa chỉ</th>
                      <th>Tình trang</th>
                      <th>Tổng tiền</th>
                      <th>Lời nhắn</th>
                      <th>Voucher</th>
                      <th>Số tiền được giảm</th>
                      <th>Hình thực thanh toán</th>
                      <th style="width: 10%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($orders as $order) : ?>
                      <tr>
                        <td><?= $order->id ?></td>
                        <td><?= $order->customer_name ?></td>
                        <td><?= $order->customer_phone_number ?></td>
                        <td><?= $order->customer_email ?></td>
                        <td><?= $order->address ?></td>
                        <td><?= $order->status ?></td>
                        <td><?= $order->total_price ?></td>
                        <td><?= $order->message ?></td>
                        <td><?= $order->voucher_id ?></td>
                        <td><?= $order->discount ?></td>
                        <td><?= $order->payment_amount ?></td>
                        <td>
                          <div class="form-button-action">
                            <a href="<?php echo ADMIN_URL . '/order/edit?id=' ?><?php echo $order->id ?>" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa">
                              <i class="fa fa-edit"></i>
                            </a>
                            <a href="" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa">
                              <i class="fa fa-times"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach ?>


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once './app/views/backend/master/footer.php';
?>