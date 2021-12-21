
<aside id="nav_menu-4" class="widget widget_nav_menu clearfix">
	<h3 class="widget-title">
		<span>Arsip Berita</span>
	</h3>

	<div class="menu-premium-themes-container">
		<ul id="menu-premium-themes" class="menu">
			<?php 
			$query = $this->db->query("SELECT id_berita, YEAR(tanggal_up_berita) as year,
				MONTH(tanggal_up_berita) as month,
				MONTHNAME(tanggal_up_berita) as month_name,
				COUNT(*) post_count
				FROM tb_berita
				GROUP BY year, MONTH(tanggal_up_berita)
				ORDER BY year DESC, month DESC;");
			$_month = '0000-00';
			foreach($query->result() as $row):
				$tanggal_a = $row->year.'-'.$row->month;
				if (date('Y-m', strtotime($tanggal_a)) !== $_month) {
					$tahun = date('Y',strtotime($tanggal_a));
				}

				$_month = date('Y-m', strtotime($tanggal_a));
					// $query = $this->db->query("SELECT * FROM tb_berita WHERE id_kategori_berita = '$row->id_kategori'");
					// $jumlah_data = $query->num_rows();
				?>
				<li style="cursor: pointer;" id="menu-item-<?= $row->id_berita ?>" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-<?= $row->id_berita ?>">
					<a href="javascript:void(0)"><?= $tahun ?></a>
					<ul id="menu-premium-themes" class="menu">
						<li style="cursor: pointer;" id="menu-item-<?= $row->id_berita ?>" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-<?= $row->id_berita ?>">
							<a href="javascript:void(0)"><?= bulan_indo($tanggal_a) ?><span style="float: right;">(<?= $row->post_count ?>)</span></a>
						</li>
					</ul>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</aside>