<?php
require_once './app/views/backend/master/master.php';
require_once './app/views/backend/master/header.php';
require_once './app/views/backend/master/sidebar.php';
?>
<!-- body -->
		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
							</div>

						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row row-card-no-pd mt--2">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i class="fas fa-motorcycle text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Xe</p>
												<h4 class="card-title">150</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i class="fas fa-map-marker-alt text-success"></i>			
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Địa điểm</p>
												<h4 class="card-title">10</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i class="fas fa-user-friends text-danger"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Tài khoản</p>
												<h4 class="card-title">15</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-shopping-cart text-primary"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Đơn hàng</p>
												<h4 class="card-title">20</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
						<h4 class="page-title">Thống kê tháng</h4>
						</div>
						<div class="col-sm-6 col-md-6">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Tài khoản mới</p>
												<h4 class="card-title">1</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-6">
							<div class="card card-stats card-info card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i class="fas fa-dolly"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Đơn hàng mới</p>
												<h4 class="card-title">10</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-6">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i class="fas fa-comment-dots"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Bình luận mới</p>
												<h4 class="card-title">10</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-6">
							<div class="card card-stats card-secondary card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-motorcycle text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Xe mới</p>
												<h4 class="card-title">5</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Biểu đồ doanh thu</div>
								</div>
								<div class="card-body">
								<div id="curve_chart" style="height: 500px"></div>
								</div>
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Đơn hàng mới nhất</div>
									<a href="">Xem danh sách</a>
								</div>
								<div class="card-body">
								<table class="table table-head-bg-success mt-4">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Khách hàng</th>
												<th scope="col">Trạng thái</th>
												<th scope="col">Tổng tiền</th>
												<th scope="col">Ngày mua hàng</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>Mark</td>
												<td>Đang xử lý</td>
												<td>300,000 đ</td>
												<td>2019-10-31</td>
											</tr>
											<tr>
												<td>2</td>
												<td>Mark</td>
												<td>Đang xử lý</td>
												<td>300,000 đ</td>
												<td>2019-10-31</td>
											</tr>
											<tr>
												<td>3</td>
												<td>Mark</td>
												<td>Đang xử lý</td>
												<td>300,000 đ</td>
												<td>2019-10-31</td>
											</tr>
											<tr>
												<td>4</td>
												<td>Mark</td>
												<td>Đang xử lý</td>
												<td>300,000 đ</td>
												<td>2019-10-31</td>
											</tr>
											<tr>
												<td>5</td>
												<td>Mark</td>
												<td>Đang xử lý</td>
												<td>300,000 đ</td>
												<td>2019-10-31</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Đánh giá, bình luận mới nhất</div>
									<a href="">Xem danh sách</a>
								</div>
								<div class="card-body">
								<table class="table table-head-bg-primary mt-4">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Tên</th>
												<th scope="col">Ngày</th>
												<th scope="col">Tiêu đề</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>Mark</td>
												<td>2019-10-31</td>
												<td>@mdo</td>
											</tr>
											<tr>
												<td>2</td>
												<td>Jacob</td>
												<td>2019-10-31</td>
												<td>@fat</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>

		</div>

	<!--   Core JS Files   -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Doanh thu'],
          ['2004',  1000],
          ['2005',  1170],
          ['2006',  660],
          ['2007',  1030]
        ]);

        var options = {
          title: 'Doanh thu năm 2019',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
	<?php
	require_once './app/views/backend/master/footer.php';
	?>