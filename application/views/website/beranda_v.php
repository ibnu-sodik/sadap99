<link type="text/css" rel="stylesheet" href="<?= base_url('assets/light-gallery/dist/css/lightgallery.min.css') ?>" />
<div class="front-page-top-section clearfix">
	<div class="widget_slider_area">
		<section id="colormag_featured_posts_slider_widget-3" class="widget widget_featured_slider widget_featured_meta clearfix">
			<div class="widget_featured_slider_inner_wrap clearfix">

				<div class="widget_slider_area_rotate">
					<?php 
					if ($berita_terbaru->num_rows() > 0):
						foreach($berita_terbaru->result() AS $row):
							$tanggal = date('Ymd', strtotime($row->tanggal_up_berita));
							?>
							<div class="single-slide displayblock">
								<figure class="slider-featured-image"  id="beritaBaru">
									<a class="beritaBaru" href="<?= base_url('uploads/berita/'.$row->gambar_berita) ?>" title="<?= $row->judul_berita ?>">
										<img style="height: 39vh;" src="<?= base_url('uploads/berita/'.$row->gambar_berita) ?>" class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image" alt="<?= $row->judul_berita ?>" loading="lazy" title="<?= $row->judul_berita ?>" />
									</a>
								</figure>
								<div class="slide-content">
									<div class="above-entry-meta">
										<span class="cat-links">
											<?php
											$split_labels = explode(",", $row->label_berita);
											foreach ($split_labels as $label):
												$query = $this->db->query("SELECT * FROM tb_label_berita WHERE slug_label = '$label'");
												$data = $query->row();
												?>
												<a title="Label : <?= $data->nama_label ?>" href="<?= site_url('label/'.$data->slug_label) ?>" style="background:<?= randomHex() ?>" rel="category tag"><?= $data->nama_label ?></a>&nbsp;
											<?php endforeach; ?>
										</span>
									</div>
									<h3 class="entry-title">
										<a href="<?= site_url('berita/'.$row->slug_berita) ?>" title="<?= $row->judul_berita ?>"><?= $row->judul_berita ?></a>
									</h3>
									<div class="below-entry-meta">
										<span class="posted-on">
											<a href="javascript:void(0)" title="Berita pada <?= tanggal_indo($row->tanggal_up_berita) ?>" rel="bookmark">
												<i class="fa fa-calendar-o"></i>
												<time class="entry-date published updated" datetime="<?= $row->tanggal_up_berita ?>"><?= tanggal_indo2($row->tanggal_up_berita) ?></time>
											</a>
										</span>
										<span class="byline">
											<span class="author vcard">
												<i class="fa fa-user"></i>
												<a class="url fn n" href="<?= site_url('author/'.$row->username) ?>" title="<?= $row->full_name ?>">
													<?= $row->full_name ?>								
												</a>
											</span>
										</span>
										<?php if($row->views_berita > 0): ?>
											<span class="comments">
												<a href="javascript:void(0)" title="Dibaca <?= $row->views_berita ?> x">
													<i class="fa fa-eye"></i>
													<?= $row->views_berita ?>
												</a>					
											</span>
										<?php endif; ?>
										<?php if($row->jumlah_komentar > 0): ?>
											<span class="comments">
												<a href="javascript:void(0)" title="<?= $row->jumlah_komentar ?> komentar">
													<i class="fa fa-comment"></i>
													<?= $row->jumlah_komentar ?>
												</a>
											</span>
										<?php endif; ?>
									</div>
								</div>
							</div>		
							<?php
						endforeach;
					endif;
					?>
				</div>
			</div>
		</section>		
	</div>

	<div class="widget_beside_slider">
		<section id="colormag_highlighted_posts_widget-3" class="widget widget_highlighted_posts widget_featured_meta clearfix">
			<div class="widget_highlighted_post_area">
				<?php 
				if ($berita_populer->num_rows() > 0):
					foreach($berita_populer->result() AS $row):
						$tanggal = date('Ymd', strtotime($row->tanggal_up_berita));
						?>
						<div class="single-article">
							<figure class="highlights-featured-image">
								<a href="<?= base_url('uploads/berita/'.$row->gambar_berita) ?>" title="<?= $row->judul_berita ?>" class="beritaPopuler">
									<img style="height: 19vh;" src="<?= base_url('uploads/berita/'.$row->gambar_berita) ?>" class="attachment-colormag-highlighted-post size-colormag-highlighted-post wp-post-image" alt="<?= $row->judul_berita ?>" loading="lazy" title="<?= $row->judul_berita ?>" srcset="<?= base_url('uploads/berita/'.$row->gambar_berita) ?> 392w, <?= base_url('uploads/berita/'.$row->gambar_berita) ?> 130w" sizes="(max-width: 392px) 100vw, 392px">
								</a>
							</figure>
							<div class="article-content">								
								<div class="above-entry-meta">
									<span class="cat-links">
										<span class="cat-links">
											<?php
											$split_labels = explode(",", $row->label_berita);
											foreach ($split_labels as $label):
												$query = $this->db->query("SELECT * FROM tb_label_berita WHERE slug_label = '$label'");
												$data = $query->row();
												?>
												<a title="Label : <?= $data->nama_label ?>" href="<?= site_url('label/'.$data->slug_label) ?>" style="background:<?= randomHex() ?>" rel="category tag"><?= $data->nama_label ?></a>&nbsp;
												<?php 
											endforeach;
											?>
										</span>
									</span>
								</div>
								<h3 class="entry-title">
									<a href="<?= site_url('berita/'.$row->slug_berita) ?>" title="<?= $row->judul_berita ?>"><?= $row->judul_berita ?></a>
								</h3>
								<div class="below-entry-meta">
									<span class="posted-on">
										<a href="javascript:void(0)" title="Berita pada <?= tanggal_indo($row->tanggal_up_berita) ?>" rel="bookmark">
											<i class="fa fa-calendar-o"></i>
											<time class="entry-date published updated" datetime="<?= $row->tanggal_up_berita ?>"><?= tanggal_indo2($row->tanggal_up_berita) ?></time>
										</a>
									</span>
									<span class="byline">
										<span class="author vcard">
											<i class="fa fa-user"></i>
											<a class="url fn n" href="<?= site_url('author/'.$row->username) ?>" title="<?= $row->full_name ?>">
												<?= $row->full_name ?>											
											</a>
										</span>
									</span>
								</div>					
							</div>
						</div>
						<?php
					endforeach;
				endif;
				?>
			</div>
		</section>		
	</div>
</div>

<div class="main-content-section clearfix">
	<div id="primary">
		<div id="content" class="clearfix">	
			<?php 
			if($data_kategori->num_rows() > 0):
				foreach($data_kategori->result() as $row):
					$id_kategori = $row->id_kategori;
					?>
					<div id="galKat-<?= $id_kategori ?>">
						<section id="colormag_featured_posts_widget-6" class="widget widget_featured_posts widget_featured_meta clearfix">
							<h3 class="widget-title" style="border-bottom-color:#757575;">
								<span style="background-color:<?= randomHex() ?>;"><?= ucwords($row->nama_kategori) ?></span>
							</h3>
							<?php 
							$sql = "SELECT tb_berita.*, tb_users.*, count(id_komentar) AS jumlah_komentar, tb_kategori_berita.* FROM tb_berita
							LEFT JOIN tb_users ON id_author = id 
							LEFT JOIN tb_komentar ON id_berita = id_komentar_berita 
							LEFT JOIN tb_kategori_berita ON id_kategori_berita = id_kategori 
							WHERE publish_berita = 1 AND id_kategori_berita = '$id_kategori' GROUP BY id_berita ORDER BY id_berita DESC LIMIT 1";
							$num_rows = $this->db->query($sql)->num_rows();
							if($num_rows > 0):
								$data = $this->db->query($sql)->row();
								$id_berita = $data->id_berita;
								$tanggal = date('Ymd', strtotime($data->tanggal_up_berita));
								?>
								<div class="first-post">
									<div class="single-article clearfix">
										<figure>
											<a href="<?= base_url('uploads/berita/'.$data->gambar_berita) ?>" title="<?= $data->judul_berita ?>" class="<?= $row->slug_kategori ?>">
												<img width="390" height="205" src="<?= base_url('uploads/berita/'.$data->gambar_berita) ?>" class="attachment-colormag-featured-post-medium size-colormag-featured-post-medium wp-post-image" alt="<?= $data->judul_berita ?>" loading="lazy" title="<?= $data->judul_berita ?>" />
											</a>
										</figure>
										<div class="article-content">
											<div class="above-entry-meta">
												<span class="cat-links">
													<?php
													$split_labels = explode(",", $data->label_berita);
													foreach ($split_labels as $label):
														$query_label = $this->db->query("SELECT * FROM tb_label_berita WHERE slug_label = '$label'");
														$data_label = $query_label->row();
														?>
														<a title="Label : <?= $data_label->nama_label ?>" href="<?= site_url('label/'.$data_label->slug_label) ?>" style="background:<?= randomHex() ?>" rel="category tag"><?= $data_label->nama_label ?></a>&nbsp;
														<?php 
													endforeach;
													?>
												</span>
											</div>		
											<h3 class="entry-title">
												<a href="<?= site_url('berita/'.$data->slug_berita) ?>" title="<?= $data->judul_berita ?>"><?= $data->judul_berita ?></a>
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
												<?php if($data->jumlah_komentar > 0): ?>
													<span class="comments">
														<a href="javascript:void(0)" title="<?= $data->jumlah_komentar ?> komentar">
															<i class="fa fa-comment"></i>
															<?= $data->jumlah_komentar ?>
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
							endif;
							$sql_followPost = "SELECT tb_berita.*, count(id_komentar) AS jumlah_komentar, tb_kategori_berita.* FROM tb_berita
							LEFT JOIN tb_komentar ON id_berita = id_komentar_berita 
							LEFT JOIN tb_kategori_berita ON id_kategori_berita = id_kategori 
							WHERE publish_berita = 1 AND id_kategori_berita IN($id_kategori) AND id_berita NOT IN($id_berita) GROUP BY id_berita ORDER BY id_berita DESC LIMIT 5";
							$fpdNumRows = $this->db->query($sql_followPost)->num_rows();
							if($fpdNumRows > 0):
								$followPostData = $this->db->query($sql_followPost)->row();
								$tanggal = date('Ymd', strtotime($followPostData->tanggal_up_berita));
								?>
								<div class="following-post">
									<div class="single-article clearfix">
										<figure>
											<a href="<?= base_url('uploads/berita/'.$followPostData->gambar_berita) ?>" title="<?= $followPostData->judul_berita ?>" class="<?= $followPostData->slug_kategori ?>">
												<img width="130" height="90" src="<?= base_url('uploads/berita/'.$followPostData->gambar_berita) ?>" class="attachment-colormag-featured-post-small size-colormag-featured-post-small wp-post-image" alt="<?= $followPostData->judul_berita ?>" loading="lazy" title="<?= $followPostData->judul_berita ?>" srcset="<?= base_url('uploads/berita/'.$followPostData->gambar_berita) ?> 130w, <?= base_url('uploads/berita/'.$followPostData->gambar_berita) ?> 392w" sizes="(max-width: 130px) 100vw, 130px" />
											</a>
										</figure>
										<div class="article-content">
											<h3 class="entry-title">
												<a href="<?= site_url('berita/'.$followPostData->slug_berita) ?>" title="<?= $followPostData->judul_berita ?>">
													<?= batasi_kata($followPostData->judul_berita, 5) ?> ...		
												</a>
											</h3>
											<div class="below-entry-meta">
												<span class="posted-on">
													<a href="javascript:void(0)" title="Berita pada <?= tanggal_indo($followPostData->tanggal_up_berita) ?>" rel="bookmark">
														<i class="fa fa-calendar-o"></i>
														<time class="entry-date published updated" datetime="<?= $followPostData->tanggal_up_berita ?>"><?= tanggal_indo2($followPostData->tanggal_up_berita) ?></time>
													</a>
												</span>
												<?php if($followPostData->views_berita > 0): ?>
													<span class="comments">
														<a href="javascript:void(0)" title="Dibaca <?= $followPostData->views_berita ?> x">
															<i class="fa fa-eye"></i>
															<?= $followPostData->views_berita ?>
														</a>	
													</span>
												<?php endif; ?>
												<?php if($followPostData->jumlah_komentar > 0): ?>
													<span class="comments">
														<a href="javascript:void(0)" title="<?= $followPostData->jumlah_komentar ?> komentar">
															<i class="fa fa-comment"></i>
															<?= $followPostData->jumlah_komentar ?>
														</a>	
													</span>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
								<?php 
							endif;
							?>
						</section>
					</div>
					<div class="clearfix"></div>
					<?php 
				endforeach;
			endif;
			?>
		</div>
	</div>
	<script src="<?= base_url('assets/light-gallery/lib/jquery.mousewheel.min.js') ?>"></script>
	<script src="<?= base_url('assets/light-gallery/dist/js/lightgallery.min.js'); ?>"></script>
	<script src="<?= base_url('assets/light-gallery/modules/lg-autoplay.min.js'); ?>"></script>
	<script src="<?= base_url('assets/light-gallery/modules/lg-share.min.js'); ?>"></script>
	<script src="<?= base_url('assets/light-gallery/modules/lg-video.min.js'); ?>"></script>
	<script src="<?= base_url('assets/light-gallery/modules/lg-zoom.min.js'); ?>"></script>
	<script src="<?= base_url('assets/light-gallery/modules/lg-thumbnail.min.js'); ?>"></script>
	<script src="<?= base_url('assets/light-gallery/modules/lg-fullscreen.min.js'); ?>"></script>
	<script type="text/javascript">
		(function ($) {
			$(".widget_slider_area_rotate").lightGallery({
				selector: '.beritaBaru',
				counter:true,
				html:true 
			});
			$(".widget_highlighted_post_area").lightGallery({
				selector: '.beritaPopuler',
				counter:true,
				html:true 
			});
			<?php 
			foreach($data_kategori->result() as $row):
				?>						
				$("#galKat-<?= $row->id_kategori ?>").lightGallery({
					selector: '.<?= $row->slug_kategori ?>',
					counter:true,
					html:true 
				});
				<?php 
			endforeach;
			?>
		})(jQuery);

	</script>