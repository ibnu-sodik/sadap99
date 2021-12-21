<link type="text/css" rel="stylesheet" href="<?= base_url('assets/light-gallery/dist/css/lightgallery.min.css') ?>" />
<?php 
$str_rep_1 = str_replace('["', '', $bulan_ini);
$str_rep_2 = str_replace('"]', '', $str_rep_1);
for ($i=0; $i <= 12 ; $i++) {
	if ($i == $str_rep_2) {
		$nama_bulan = date('F');
		echo($nama_bulan);
	}
}
?>
<div class="page-header">
	<h1>
		<?= $title; ?>
		<?php if (isset($sm_text)): ?>
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				<?= $sm_text; ?>
			</small>			
		<?php endif ?>
	</h1>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="widget-box transparent">
			<div class="widget-header">
				<h4 class="widget-title lighter smaller">
					<i class="ace-icon fa fa-clock-o orange"></i>Realtime Data
				</h4>
				<div class="widget-toolbar no-border">
					<ul class="nav nav-tabs">
						<li class="active">
							<a data-toggle="tab" href="#task-tab" aria-expanded="false">Log Aktivitas Users</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main padding-4">
					<div class="tab-content padding-8">
						<div id="task-tab" class="tab-pane active">
							<h4 class="smaller lighter green">
								<i class="ace-icon fa fa-list"></i>
								Aktivitas Users
							</h4>
							<div class="table-responsive">
								<table class="table table-hover table-bordered tabelKu" id="tabelKu" width="100%">
									<thead>
										<tr>
											<th class="text-center">Nama</th>
											<th class="text-center">Tanggal</th>
											<th class="text-center">Jam</th>
											<th class="text-center">Aktivitas</th>
										</tr>
									</thead>
									<tbody id="dataAktivitas">
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-xs-12 col-sm-12 widget-container-col">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Statistik Pengunjung Setiap Hari</h4>
				<div class="widget-toolbar">
					<a href="#" data-action="collapse">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div id="statistikVisitor"></div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-xs-12 col-sm-6 widget-container-col">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Statistik Pengunjung Setiap Bulan</h4>
				<div class="widget-toolbar">
					<a href="#" data-action="collapse">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div id="statistikVisitorPerBulan"></div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-xs-12 col-sm-6 widget-container-col">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Statistik Pengunjung Setiap Tahun</h4>
				<div class="widget-toolbar">
					<a href="#" data-action="collapse">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div id="statistikVisitorPerTahun"></div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-xs-12 col-sm-6 widget-container-col">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Statistik Browser Pengunjung</h4>
				<div class="widget-toolbar">
					<a href="#" data-action="collapse">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div id="stsistikBrowser"></div>
				</div>
			</div>
		</div>

	</div>
	<div class="col-xs-12 col-sm-6 widget-container-col">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Statistik Platform Pengunjung</h4>
				<div class="widget-toolbar">
					<a href="#" data-action="collapse">
						<i class="ace-icon fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div id="stsistikPlatform"></div>
				</div>
			</div>
		</div>

	</div>
</div>
<script src="<?= base_url('fileAdmin/highcharts/highchart.js') ?>"></script>

<script src="<?= base_url('fileAdmin/highcharts/highchart-more.js') ?>"></script>

<script src="<?= base_url('fileAdmin/highcharts/dumbbell.js') ?>"></script>

<script src="<?= base_url('fileAdmin/highcharts/lollipop.js') ?>"></script>

<script src="<?= base_url('fileAdmin/highcharts/exporting.js') ?>"></script>

<script src="<?= base_url('fileAdmin/highcharts/export-data.js') ?>"></script>

<script src="<?= base_url('fileAdmin/highcharts/accessibility.js') ?>"></script>
<script type="text/javascript">
	// setInterval(function() {
	// 	$.ajax({
	// 		url 		: "<?= base_url('admin/testimoni/get_data') ?>",
	// 		type 		: "POST",
	// 		dataType 	: "JSON",
	// 		data 		: {},
	// 		success 	: function(data) {
	// 			$('#dataTestimoni').html(data.data_testimoni);
	// 			$('#jumlahBaru').html(data.badge);
	// 			$('#tabeltestimoni').dataTable();
	// 		}
	// 	});

	// }, 2000);
	setInterval(function() {
		$.ajax({
			url 		: "<?= base_url('admin/dashboard/get_aktivitas') ?>",
			type 		: "POST",
			dataType 	: "JSON",
			data 		: {},
			success 	: function(data) {
				$('#dataAktivitas').html(data.data_aktivitas);
				$('.tabelKu').dataTable();
			}
		});

	}, 2000);
		// Statistik Pengunjung setiap tahun

		Highcharts.chart('statistikVisitorPerTahun', {
			chart: {
				type: 'lollipop'
			},
			accessibility: {
				point: {
					valueDescriptionFormat: '{index}. {xDescription}, {point.y}.'
				}
			},
			legend: {
				enabled: false
			},
			subtitle: {
				text: 'Statistik Pengunjung Tiap Tahun'
			},
			title: {
				text: 'Statistik Pengunjung Tiap Tahun'
			},
			tooltip: {
				shared: true
			},
			xAxis: {
				type: 'category'
			},
			yAxis: {
				title: {
					text: 'Total Kunjungan'
				}
			},
			series: [{
				name: 'Jumlah Pengunjung',
				data: [
				<?php 
				foreach($statistik_visitor_per_tahun as $value):
					$tahun = $value->tahun;
					$jumlah = $value->jumlah;
					?>
					{
						name: '<?= $tahun ?>',
						low: <?= $jumlah ?>
					}, 
				<?php endforeach; ?>
				]
			}]
		});
		// Statistik Pengunjung setiap bulan

		Highcharts.chart('statistikVisitorPerBulan', {
			chart: {
				type: 'lollipop'
			},
			accessibility: {
				point: {
					valueDescriptionFormat: '{index}. {xDescription}, {point.y}.'
				}
			},
			legend: {
				enabled: false
			},
			subtitle: {
				<?php 
				foreach ($statistik_visitor_per_bulan as $value) {
					$tahun = $value->tahun;
				}
				?>
				text: 'Tahun <?= $tahun ?>'
			},
			title: {
				text: 'Statistik Pengunjung Tiap Bulan'
			},
			tooltip: {
				shared: true
			},
			xAxis: {
				type: 'category'
			},
			yAxis: {
				title: {
					text: 'Total Kunjungan'
				}
			},
			series: [{
				name: 'Jumlah Pengunjung',
				data: [
				<?php 
				foreach($statistik_visitor_per_bulan as $value):
					$bulan = $value->bulan;
					$jumlah = $value->jumlah;
					$arr_bulan = array(
						01=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
					);
					foreach ($arr_bulan as $key => $value) {
						if ($bulan == $key) {
							$per_bulan = $value;
						}
					}
					?>
					{
						name: '<?= $per_bulan ?>',
						low: <?= $jumlah ?>
					}, 
				<?php endforeach; ?>
				]
			}]
		});
		// Statistik Pengunjung setiap hari

		Highcharts.chart('statistikVisitor', {
			chart: {
				type: 'lollipop'
			},
			accessibility: {
				point: {
					valueDescriptionFormat: '{index}. {xDescription}, {point.y}.'
				}
			},
			legend: {
				enabled: false
			},
			subtitle: {
				text: 'Selama bulan <?= $nama_bulan ?> Tahun <?= date('Y') ?>'
			},
			title: {
				text: 'Statistik Pengunjung'
			},
			tooltip: {
				shared: true
			},
			xAxis: {
				type: 'category'
			},
			yAxis: {
				title: {
					text: 'Total Kunjungan'
				}
			},
			series: [{
				name: 'Jumlah Pengunjung',
				data: [
				<?php 
				foreach($statistik_visitor as $value):
					$tanggal = $value->tanggal;
					$jumlah = $value->jumlah;
					?>
					{
						name: '<?= $tanggal.' '.$nama_bulan ?>',
						low: <?= $jumlah ?>
					}, 
				<?php endforeach; ?>
				]
			}]
		});
		// Statistik Platform

		Highcharts.chart('stsistikPlatform', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: 0,
				plotShadow: false
			},
			title: {
				text: 'Platform<br>Pengunjung',
				align: 'center',
				verticalAlign: 'middle',
				y: 60
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			accessibility: {
				point: {
					valueSuffix: '%'
				}
			},
			plotOptions: {
				pie: {
					dataLabels: {
						enabled: true,
						distance: -50,
						style: {
							fontWeight: 'bold',
							color: 'white'
						}
					},
					startAngle: -90,
					endAngle: 90,
					center: ['50%', '75%'],
					size: '110%'
				}
			},
			series: [{
				type: 'pie',
				name: 'Browser share',
				innerSize: '50%',
				data: [
				<?php 
				foreach($statistik_platform as $row):
					$platform = $row->platform;
					$jumlah = $row->jumlah;
					?>
					{
						name : '<?= $platform ?>',
						y : <?= $jumlah ?>
					},
				<?php endforeach ?>
				]
			}]

		});

	// Statistik Browser

	Highcharts.chart('stsistikBrowser', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: 0,
			plotShadow: false
		},
		title: {
			text: 'Browser<br>Pengunjung',
			align: 'center',
			verticalAlign: 'middle',
			y: 60
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				dataLabels: {
					enabled: true,
					distance: -50,
					style: {
						fontWeight: 'bold',
						color: 'white'
					}
				},
				startAngle: -90,
				endAngle: 90,
				center: ['50%', '75%'],
				size: '110%'
			}
		},
		series: [{
			type: 'pie',
			name: 'Browser share',
			innerSize: '50%',
			data: [
			<?php 
			foreach($statistik_browser as $row):
				$browser = $row->browser;
				$jumlah = $row->jumlah;
				?>
				{
					name : '<?= $browser ?>',
					y : <?= $jumlah ?>
				},
			<?php endforeach ?>
			]
		}]

	});
</script>