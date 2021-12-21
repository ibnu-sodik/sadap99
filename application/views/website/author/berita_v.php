<link type="text/css" rel="stylesheet" href="<?= base_url('assets/light-gallery/dist/css/lightgallery.min.css') ?>" />
<div id="primary">
	<div id="content" class="clearfix">

		<header class="page-header">
			<h1 class="page-title" style="border-bottom-color:#757575">
				<span style="background-color:<?= randomHex() ?>"><?= $bc_title ?></span>
			</h1>					
		</header>
		<div class="article-container">
			<?php 
			if($berita_author->num_rows() > 0):
				foreach($berita_author->result() as $row):
					$tanggal = date('Ymd', strtotime($row->tanggal_up_berita));
					?>
					<article id="post-<?= $row->id_berita ?>" class="post-<?= $row->id_berita ?> post type-post status-publish format-standard has-post-thumbnail hentry category-<?= $row->slug_kategori ?>">

						<div class="featured-image">
							<a href="<?= base_url('uploads/berita/'.$row->gambar_berita) ?>" title="<?= $row->judul_berita ?>" class="itemBerita">
								<img width="800" height="445" src="<?= base_url('uploads/berita/'.$row->gambar_berita) ?>" class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image" alt="<?= $row->judul_berita ?>" loading="lazy">				
							</a>
						</div>

						<div class="article-content clearfix">

							<div class="above-entry-meta">
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
							</div>
							<header class="entry-header">
								<h2 class="entry-title">
									<a href="<?= site_url('berita/'.$row->slug_berita) ?>" title="<?= $row->judul_berita ?>"><?= $row->judul_berita ?></a>
								</h2>
							</header>

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
											dibaca <?= $row->views_berita ?> x
										</a>					
									</span>
								<?php endif; ?>
							</div>
							<div class="entry-content clearfix">
								<p><?= batasi_kata($row->deskripsi_berita, 23) ?> ...</p>
							</div>
						</div>
					</article>
					<?php 
				endforeach;
			endif;
			?>
		</div>
		<?= $pagination; ?>

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
				$(".article-container").lightGallery({
					selector: '.itemBerita',
					counter:true,
					html:true 
				});
			})(jQuery);

		</script>
	</div>
</div>