<header id="masthead" class="site-header clearfix ">
	<div id="header-text-nav-container" class="clearfix">

		<div class="news-bar">
			<div class="inner-wrap clearfix">
				<div class="date-in-header"><?= tanggal_indo(date('Y-m-d')) ?></div>
				<div class="breaking-news">
					<strong class="breaking-news-latest">Terbaru:</strong>
					<ul class="newsticker">
						<?php 
						if ($berita_terbaru->num_rows() > 0):
							foreach($berita_terbaru->result() AS $row):
								$tanggal = date('Ymd', strtotime($row->tanggal_up_berita));
								?>
								<li>
									<a href="<?= site_url('berita/'.$row->slug_berita) ?>" title="<?= $row->judul_berita ?>">
										<?= $row->judul_berita ?>
									</a>
								</li>		
								<?php
							endforeach;
						endif;
						?>
					</ul>
				</div>


				<div class="social-links clearfix">
					<ul>
						<?php 
						$sql_query = $this->db->query("SELECT * FROM tb_sosmedweb ORDER BY nama_sosmed ASC");
						foreach($sql_query->result() as $row):
							?> 
							<li>
								<a href="<?= $row->link_sosmed ?>" target="_blank" title="<?= $row->nama_sosmed ?>">
									<i class="<?= $row->ikon_sosmed ?>"></i>
								</a>
							</li>
							<?php 
						endforeach;
						?>
					</ul>
				</div>
			</div>
		</div>


		<div class="inner-wrap">
			<div id="header-text-nav-wrap" class="clearfix">
				<div id="header-left-section">
					<div id="header-logo-image">
						<a href="<?= base_url() ?>" class="custom-logo-link" rel="home" aria-current="page">
							<?php 
							$file = file_exists(base_url('assete/images/'.$site_logo));
							if (isset($file) && $site_logo != ""): 
								?>
								<img width="265" height="90" src="<?= base_url('assets/images/'.$site_logo); ?>" class="custom-logo" alt="<?= $site_title ?>" />
								<?php 
							else:
								?>
								<?= $site_name; ?>
								<?php 
							endif;
							?>
						</a>						
					</div>
					<div id="header-text" class="screen-reader-text">
						<h1 id="site-title">
							<a href="<?= base_url() ?>" title="<?= $site_title ?>" rel="home"><?= $site_title ?></a>
						</h1>

						<p id="site-description"><?= $site_description ?></p>
					</div>
				</div>
			</div>
		</div>

		<nav id="site-navigation" class="main-navigation clearfix" role="navigation" style="">
			<div class="inner-wrap clearfix">
				<?php 
				$url_judul = $this->uri->segment(1);
				?>
				<div class="home-icon <?= (($url_judul == "" || $url_judul == "beranda") ? 'front_page_on' : '') ?>">
					<a href="<?= base_url() ?>" title="<?= $site_title ?>">
						<i class="fa fa-home"></i>
					</a>
				</div>

				<div class="search-random-icons-container">
					<div class="random-post">
						<?php 
						if ($berita_random->num_rows() > 0):
							foreach($berita_random->result() AS $row):
								$tanggal = date('Ymd', strtotime($row->tanggal_up_berita));
								?>
								<a href="<?= site_url('berita/'.$row->slug_berita) ?>" title="Perlihatkan pos acak">
									<i class="fa fa-random"></i>
								</a>	
								<?php
							endforeach;
						endif;
						?>
					</div>

					<div class="top-search-wrap">
						<i class="fa fa-search search-top"></i>
						<div class="search-form-top">
							<form action="<?= base_url('pencarian') ?>" class="search-form searchform clearfix" method="GET" role="search">
								<div class="search-wrap">
									<input type="search" class="s field" name="kata" placeholder="Cari" />
									<button class="search-icon" type="submit"></button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<p class="menu-toggle" ></p>
				<div class="menu-primary-container">
					<ul id="menu-primary" class="menu">
						<?php 
						$uri_nama = $this->uri->segment(1);
						$sql_m1 = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'main' AND parent_id = '0' ORDER BY urut");

						if ($sql_m1->num_rows() > 0):
							foreach ($sql_m1->result() as $row):
								if ($uri_nama == strtolower($row->judul)) {
									$link_aktif = "current-menu-item";
								}else{
									$link_aktif = "";
								}
								$id_menu = $row->id_menu;
								$sql_m2 = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'main' AND parent_id = '$id_menu' ORDER BY urut");
								if($sql_m2->num_rows() > 0):
									?>
									<li id="menu-item-<?= $id_menu ?>" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-<?= $id_menu ?> <?= $link_aktif ?>">
										<a title="<?= $row->judul ?>" href="<?= $row->link; ?>"><?= strtoupper($row->judul) ?></a>
										<ul class="sub-menu">
											<?php foreach ($sql_m2->result() as $row2): ?>
												<li id="menu-item-<?= $row2->id_menu ?>" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-<?= $row2->id_menu ?>">
													<a title="<?= $row2->judul ?>" rel="noopener" href="<?= $row2->link ?>"><?= ucwords($row2->judul) ?></a>
												</li>
											<?php endforeach ?>
										</ul>
									</li>
									<?php 
								else:
									?>
									<li id="menu-item-<?= $row->id_menu ?>" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-<?= $row->id_menu ?> <?= $link_aktif ?>">
										<a href="<?= $row->link ?>"><?= ucwords($row->judul) ?></a>
									</li>	
									<?php 
								endif;
							endforeach;
						endif;
						?>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</header>
