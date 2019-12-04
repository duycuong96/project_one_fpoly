<?php
require_once './app/views/backend/master/master.php';


?>
<!-- body -->
<div class="">
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">

			</div>
		</div>
		<div class="page-inner mt--5">
			<div class="row row-card-no-pd mt--2">
				<div class="col-sm-12 col-md-12">
					<div class="card card-stats card-round">
						<div class="card-body ">
							<div class="row">
								<div class="col-12">
									<h1 class="text-center text-primary">Đăng nhập</h1>
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

		</div>
	</div>

</div>

<!--   Core JS Files   -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	google.charts.load('current', {
		'packages': ['corechart']
	});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['Year', 'Doanh thu'],
			['2004', 1000],
			['2005', 1170],
			['2006', 660],
			['2007', 1030]
		]);

		var options = {
			title: 'Doanh thu năm 2019',
			curveType: 'function',
			legend: {
				position: 'bottom'
			}
		};

		var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

		chart.draw(data, options);
	}
</script>
<?php
require_once './app/views/backend/master/footer.php';
?>