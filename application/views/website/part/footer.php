</div>
</div>

<div class="swal-warning" data-flashdata="<?= $this->session->flashdata('swalWarning'); ?>"></div>
<div class="swal-info" data-flashdata="<?= $this->session->flashdata('swalInfo'); ?>"></div>
<div class="swal-error" data-flashdata="<?= $this->session->flashdata('swalError'); ?>"></div>
<div class="swal-sukses" data-flashdata="<?= $this->session->flashdata('swalSukses'); ?>"></div>

<div class="pnotify-sukses" data-flashdata="<?= $this->session->flashdata('pnotifySukses'); ?>"></div>
<div class="pnotify-notice" data-flashdata="<?= $this->session->flashdata('pnotifyWarning'); ?>"></div>
<div class="pnotify-info" data-flashdata="<?= $this->session->flashdata('pnotifyInfo'); ?>"></div>
<div class="pnotify-error" data-flashdata="<?= $this->session->flashdata('pnotifyError'); ?>"></div>

<footer id="colophon" class="clearfix ">
	<div class="footer-widgets-wrapper">
		<div class="inner-wrap">
			<div class="footer-widgets-area clearfix">
				<div class="tg-footer-main-widget">
					<div class="tg-first-footer-widget">
						<aside id="text-10" class="widget widget_text clearfix">
							<h3 class="widget-title">
								<span>Tentang Kita</span>
							</h3>			
							<div class="textwidget">
								<?php 
								$file = file_exists(base_url('assete/images/'.$site_logo));
								if (isset($file) && $site_logo != ""): ?>
									<a title="<?= $site_name ?>" href="<?= base_url() ?>">
										<img alt="<?= $site_name ?>" src="<?= base_url('assets/images/'.$site_logo); ?>">
									</a>
									<?php 
								else: 
									?>
									<?= $site_name; ?>
									<?php 
								endif;
								?>
								<br/><?= $site_description ?>
							</div>
						</aside>				
					</div>
				</div>

				<div class="tg-footer-other-widgets">
					<?php 
					$query = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'second' AND parent_id = '0' ORDER BY urut ");
					if ($query->num_rows() > 0):
						foreach ($query->result() as $row):	
							?>
							<div class="tg-second-footer-widget">
								<aside id="text-11" class="widget widget_text clearfix">
									<h3 class="widget-title">
										<span><?= $row->judul ?></span>
									</h3>		
									<div class="textwidget">
										<ul>
											<?php 
											$id_menu = $row->id_menu;
											$sql_m2 = $this->db->query("SELECT * FROM tb_menu WHERE kategori_menu = 'second' AND parent_id = '$id_menu' ORDER BY urut");
											if($sql_m2->num_rows() > 0):
												?>
												<?php foreach ($sql_m2->result() as $row2): ?>
													<li>
														<a title="<?= $row2->judul ?>" target="_blank" href="<?= $row2->link; ?>" rel="noopener"><?= ucwords($row2->judul) ?></a>
													</li>
												<?php endforeach ?>
												<?php 
											endif;
											?>
										</ul>
									</div>
								</aside>				
							</div>
							<?php 
						endforeach;
					endif;
					?>
					<div class="tg-fourth-footer-widget">
						<aside id="colormag_300x250_advertisement_widget-6" class="widget widget_300x250_advertisement clearfix">
							<div class="advertisement_300x250">
								<div class="advertisement-title">
									<h3 class="widget-title">
										<span>Media Promosi</span>
									</h3>				
								</div>
								<div class="advertisement-content">
									<iframe width="100%" height="250" src="https://www.youtube.com/embed/jYZ7TW0ogDs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>	
							</div>

						</aside>
						<aside id="text-13" class="widget widget_text clearfix">		
							<div class="textwidget">Jasa pembuatan Aplikasi berbasis Website termurah dan TERPERCAYA.</div>
						</aside>				
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-socket-wrapper clearfix">
		<div class="inner-wrap">
			<div class="footer-socket-area">
				<div class="footer-socket-right-section">
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

				<div class="footer-socket-left-section">
					<div class="copyright">Hak Cipta &copy; <?= date('Y') ?> 
					<a href="<?= base_url() ?>" title="<?= $site_title ?>" >
						<span><?= $site_title ?></span>
					</a>. Keseluruhan Hak Cipta.<br>Tema: 
					<a href="https://themegrill.com/themes/colormag" target="_blank" title="ColorMag" rel="nofollow">
						<span>ColorMag</span>
					</a> oleh ThemeGrill. Dipersembahkan oleh 
					<a href="https://wordpress.org" target="_blank" title="WordPress" rel="nofollow">
						<span>WordPress</span>
					</a>.
				</div>	
			</div>
		</div>
	</div>
</div>
</footer>
<a href="#masthead" id="scroll-up"><i class="fa fa-chevron-up"></i></a>
</div>

<script type='text/javascript' src='<?= base_url() ?>assets/js/comment-reply.min.js' id='comment-reply-js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/themes/colormag/js/jquery.bxslider.min.js' id='colormag-bxslider-js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/themes/colormag/js/sticky/jquery.sticky.min.js' id='colormag-sticky-menu-js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/themes/colormag/js/news-ticker/jquery.newsTicker.min.js' id='colormag-news-ticker-js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/themes/colormag/js/magnific-popup/jquery.magnific-popup.min.js' id='colormag-featured-image-popup-js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/themes/colormag/js/navigation.min.js' id='colormag-navigation-js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/themes/colormag/js/fitvids/jquery.fitvids.min.js' id='colormag-fitvids-js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/themes/colormag/js/skip-link-focus-fix.min.js' id='colormag-skip-link-focus-fix-js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/themes/colormag/js/colormag-custom.min.js' id='colormag-custom-js'></script>
<script type='text/javascript' src='<?= base_url() ?>assets/js/wp-embed.min.js' id='wp-embed-js'></script>

<script src="<?= base_url() ?>fileAdmin/js/sweetalert.min.js"></script>
<script src="<?= base_url() ?>fileAdmin/js/notifikasi.js"></script>

</body>
</html>
