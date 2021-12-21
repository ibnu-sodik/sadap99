
<div id="secondary">
	<?php 
	$num_rows = $berita_review->num_rows();
	if($num_rows > 0):
		$data = $berita_review->row();
		$tanggal = date('Ymd', strtotime($data->tanggal_up_berita));
		?>
		<aside id="colormag_featured_posts_vertical_widget-7" class="widget widget_featured_posts widget_featured_posts_vertical widget_featured_meta clearfix">
			<h3 class="widget-title" style="border-bottom-color:#757575;">
				<span style="background-color:<?= randomHex() ?>;">Terakhir Dibaca</span>
			</h3>
			<div class="first-post">
				<div class="single-article clearfix">
					<figure>
						<a href="<?= base_url('uploads/berita/'.$data->gambar_berita) ?>" title="<?= $data->judul_berita ?>" class="image-popup">
							<img width="390" height="205" src="<?= base_url('uploads/berita/'.$data->gambar_berita) ?>" class="attachment-colormag-featured-post-medium size-colormag-featured-post-medium wp-post-image" alt="<?= $data->judul_berita ?>" loading="lazy" title="<?= $data->judul_berita ?>" />
						</a>
					</figure>
					<div class="article-content">
						<div class="above-entry-meta">
							<span class="cat-links">
								<a href="<?= site_url('kategori/'.$data->slug_kategori) ?>" style="background:<?= randomHex() ?>" rel="category tag">
									<?= ucwords($data->nama_kategori) ?>											
								</a>&nbsp;
							</span>
						</div>		
						<h3 class="entry-title">
							<a href="<?= site_url('berita/'.$data->slug_berita) ?>" title="<?= $data->judul_berita ?>">
								<?= $data->judul_berita ?>	
							</a>
						</h3>
						<div class="below-entry-meta">
							<span class="posted-on">
								<a href="javascript:void(0)" title="Berita pada <?= tanggal_indo($data->tanggal_up_berita) ?>" rel="bookmark">
									<i class="fa fa-calendar-o"></i>
									<time class="entry-date published updated" datetime="<?= $data->tanggal_up_berita ?>"><?= tanggal_indo2($data->tanggal_up_berita) ?></time>
								</a>
							</span>
							<span class="byline">
								<span class="author vcard">
									<a class="url fn n" href="<?= site_url('author/'.$data->username) ?>" title="<?= $data->full_name ?>">
										<i class="fa fa-user"></i>
										<?= $data->full_name ?>								
									</a>
								</span>
							</span>
							<?php if($data->views_berita > 0): ?>
								<span class="comments">											
									<a href="javascript:void(0)" title="Dibaca <?= $data->views_berita ?> x">
										<i class="fa fa-eye"></i>
										<?= $data->views_berita ?>
									</a>	
								</span>
							<?php endif; ?>
						</div>
						<div class="entry-content">
							<p><?= batasi_kata($data->deskripsi_berita, 23) ?> ...</p>
						</div>
					</div>
				</div>
			</div>
			<?php 
			if($berita_refiew_follow->num_rows() > 0):
				foreach($berita_refiew_follow->result() as $row):
					$tanggal = date('Ymd', strtotime($row->tanggal_up_berita));
					?>
					<div class="following-post">
						<div class="single-article clearfix">
							<figure>
								<a href="<?= base_url('uploads/berita/'.$row->gambar_berita) ?>" title="<?= $row->judul_berita ?>" class="image-popup">
									<img width="130" height="90" src="<?= base_url('uploads/berita/'.$row->gambar_berita) ?>" class="attachment-colormag-featured-post-small size-colormag-featured-post-small wp-post-image" alt="<?= $row->judul_berita ?>" loading="lazy" title="<?= $row->judul_berita ?>" srcset="<?= base_url('uploads/berita/'.$row->gambar_berita) ?> 130w, <?= base_url('uploads/berita/'.$row->gambar_berita) ?> 392w" sizes="(max-width: 130px) 100vw, 130px">
								</a>
							</figure>
							<div class="article-content">
								<h3 class="entry-title">
									<a href="<?= site_url('berita/'.$row->slug_berita) ?>" title="<?= $row->judul_berita ?>"><?= batasi_kata($row->judul_berita, 5) ?> ...</a>
								</h3>
								<div class="below-entry-meta">
									<span class="posted-on">
										<a href="javascript:void(0)" title="Berita pada <?= tanggal_indo($row->tanggal_up_berita) ?>" rel="bookmark">
											<i class="fa fa-calendar-o"></i>
											<time class="entry-date published updated" datetime="<?= $row->tanggal_up_berita ?>"><?= tanggal_indo2($row->tanggal_up_berita) ?></time>
										</a>
									</span>
									<?php if($row->views_berita): ?>
										<span class="comments">
											<a href="javascript:void(0)" title="Dibaca <?= $row->views_berita ?> x">
												<i class="fa fa-eye"></i>
												<?= $row->views_berita ?>
											</a>	
										</span>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					<?php 
				endforeach;
			endif;
			?>
		</aside>
		<?php 
	endif;
	?>
	<aside id="nav_menu-3" class="widget widget_nav_menu clearfix">
		<h3 class="widget-title">
			<span>Kategori Berita</span>
		</h3>
		<div class="menu-premium-themes-container">
			<ul id="menu-premium-themes" class="menu">
				<?php 
				$query = $this->db->query("SELECT * FROM tb_kategori_berita ORDER BY nama_kategori ASC");
				foreach($query->result() as $row):
					$query = $this->db->query("SELECT * FROM tb_berita WHERE id_kategori_berita = '$row->id_kategori'");
					$jumlah_data = $query->num_rows();
					?>
					<li style="cursor: pointer;" id="menu-item-497" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-497">
						<a href="<?= site_url('kategori/'.$row->slug_kategori) ?>"><?= ucwords($row->nama_kategori) ?><span style="float: right;">(<?= $jumlah_data ?>)</span></a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</aside>
</div>