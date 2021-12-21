	<div id="primary">
		<div id="content" class="clearfix">
			<article id="post-<?= $id_berita ?>" class="post-<?= $id_berita ?> post type-post status-publish format-standard has-post-thumbnail hentry category-<?= $slug_kategori ?>">

				<div class="featured-image">
					<a href="<?= $gambar ?>" class="image-popup">
						<img width="800" height="445" src="<?= $gambar ?>" class="attachment-colormag-featured-image size-colormag-featured-image wp-post-image" alt="<?= $title ?>" loading="lazy">
					</a>
				</div>
				<div class="article-content clearfix">
					<div class="above-entry-meta">
						<span class="cat-links">
							<?php
							$split_labels = explode(",", $labels);
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
						<h1 class="entry-title"><?= $title ?></h1>
					</header>
					<div class="below-entry-meta">
						<span class="posted-on">
							<?php 
							$tanggal = date('Ymd', strtotime($post_date));
							?>
							<a href="javascript:void(0)" title="Berita pada <?= tanggal_indo($post_date) ?>" rel="bookmark">
								<i class="fa fa-calendar-o"></i>
								<time class="entry-date published updated" datetime="<?= $post_date ?>"><?= tanggal_indo2($post_date) ?></time>
							</a>
						</span>
						<span class="byline">
							<span class="author vcard">
								<i class="fa fa-user"></i>
								<a class="url fn n" href="<?= site_url('author/'.$username) ?>" title="<?= $author ?>">
									<?= $author ?>											
								</a>
							</span>
						</span>
						<span class="byline">
							<a href="<?= site_url('kategori/'.$slug_kategori) ?>">
								<i class="fa fa-tag"></i>
								<?= $nama_kategori ?>
							</a>
						</span>
						<?php if($views_berita > 0): ?>
							<span class="comments">
								<a href="javascript:void(0)" title="Dibaca <?= $views_berita ?> x">
									<i class="fa fa-eye"></i>
									dibaca <?= $views_berita ?> x
								</a>					
							</span>
						<?php endif; ?>
						<?php if($jumlah_komentar > 0): ?>
							<span class="comments">
								<a href="javascript:void(0)">
									<i class="fa fa-comment"></i>
									<?= $jumlah_komentar ?> Komentar
								</a>					
							</span>
						<?php endif; ?>
					</div>
					<div class="entry-content clearfix">
						<?= $konten ?>
					</div>

					<div class="pgntn-page-pagination pgntn-bottom">
						<div class="pgntn-page-pagination-block">
							<div class="pgntn-page-pagination-intro">Share via :</div>
							<a rel="nofollow" class="page-numbers" title="LinkedIn" href="javascript:void(0)" onclick="javascript:openSocialShare('https://www.linkedin.com/shareArticle?mini=true&url=<?= site_url("berita/".$slug) ?>');"><i class="fa fa-linkedin"></i></a>
							<a rel="nofollow" class="page-numbers" title="Gmail" href="javascript:void(0)" onclick="javascript:openSocialShare('https://mail.google.com/mail/u/0/?ui=2&view=cm&fs=1&tf=1&su=<?= $title ?>&body=<?= site_url("berita/".$slug) ?>');"><i class="fa fa-envelope"></i></a>
							<a rel="nofollow" class="page-numbers" title="Twitter" href="javascript:void(0)" onclick="javascript:openSocialShare('http://twitter.com/share?text=<?=$title?>&url=<?=site_url("berita/".$slug)?>')"><i class="fa fa-twitter"></i></a>
							<a rel="nofollow" class="page-numbers" title="Facebook" href="javascript:void(0)" onclick="javascript:openSocialShare('https://www.facebook.com/sharer.php?u=<?= site_url("berita/".$slug) ?>');"><i class="fa fa-facebook"></i></a>
							<a rel="nofollow" class="page-numbers" title="Telegram" href="javascript:void(0)" onclick="javascript:openSocialShare('https://telegram.me/share/url?url=<?= site_url("berita/".$slug) ?>');"><i class="fa fa-telegram"></i></a>
							<a rel="nofollow" class="page-numbers" title="WhatsApp" href="javascript:void(0)" onclick="javascript:openSocialShare('https://wa.me/?text=<?= $title.' | '.site_url("berita/".$slug) ?>')" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>		
						</div>
						<div class="clear"></div>
					</div>

				</div>
			</article>
			<?php 
			$prev = $berita_sebelumnya;
			$next = $berita_selanjutnya;
			if (($prev->num_rows() > 0) OR ($next->num_rows() > 0)):
				?>
			<ul class="default-wp-page clearfix">
				<?php 
				if ($prev->num_rows() > 0):
					foreach ($prev->result() as $row):
						?>
						<li class="previous">
							<a href="<?= site_url('berita/'.$row->slug_berita) ?>" rel="prev" title="<?= $row->judul_berita ?>">
								<span class="meta-nav">←</span>
								<?= batasi_kata($row->judul_berita, 5) ?>...
							</a>
						</li>
						<?php 
					endforeach;
				endif;
				?>
				<?php 
				if ($next->num_rows() > 0):
					foreach ($next->result() as $row):
						?>
						<li class="next">
							<a href="<?= site_url('berita/'.$row->slug_berita) ?>" rel="next" title="<?= $row->judul_berita ?>">
								<?= batasi_kata($row->judul_berita, 5) ?>...
								<span class="meta-nav">→</span>
							</a>
						</li>
						<?php 
					endforeach;
				endif;
				?>
			</ul>
			<?php
		endif;
		?>
		<div class="author-box">
			<?php 
			$q_author = $this->db->get_where('tb_users', array('id' => $id_author));
			$data_users = $q_author->row();
			if ($q_author->num_rows() > 0):
				?>
				<div class="author-img">
					<?php
					if ($q_author->num_rows() > 0 && !empty($data_users->foto) && file_exists('uploads/users/'.$data_users->foto)) {
						$link_foto = base_url('uploads/users/'.$data_users->foto);
					}else{
						$link_foto = get_gravatar($data_users->email);
					}
					?>
					<img alt="" src="<?= $link_foto ?>" srcset="<?= $link_foto ?> 2x" class="avatar avatar-100 photo" height="100" width="100" loading="lazy">
				</div>
				<h4 class="author-name"><?= $author ?></h4>
				<p class="author-description"><?= $data_users->user_info ?></p>
			<?php endif; ?>
		</div>
		<?php if($berita_rekomendasi->num_rows() > 0): ?>
			<div class="related-posts-wrapper">
				<h4 class="related-posts-main-title">
					<i class="fa fa-thumbs-up"></i>
					<span>Anda Juga Mungkin Suka</span>
				</h4>
				<?php 
				foreach($berita_rekomendasi->result() as $row):
					$tanggal = date('Ymd', strtotime($row->tanggal_up_berita));
					?>
					<div class="related-posts clearfix">
						<div class="single-related-posts">
							<div class="related-posts-thumbnail">
								<a href="<?= base_url('uploads/berita/'.$row->gambar_berita) ?>" title="<?= $row->judul_berita ?>">
									<img width="390" height="205" src="<?= base_url('uploads/berita/'.$row->gambar_berita) ?>" class="attachment-colormag-featured-post-medium size-colormag-featured-post-medium wp-post-image" alt="<?= $row->judul_berita ?>" loading="lazy">							
								</a>
							</div>

							<div class="article-content">
								<h3 class="entry-title">
									<a href="<?= site_url('berita/'.$row->slug_berita) ?>" rel="bookmark" title="<?= $row->judul_berita ?>">
										<?= $row->judul_berita ?>						
									</a>
								</h3>

								<div class="below-entry-meta">
									<span class="posted-on">
										<a href="javascript:void(0)" title="Berita pada <?= tanggal_indo($row->tanggal_up_berita) ?>" rel="bookmark">
											<i class="fa fa-calendar-o"></i>
											<time class="entry-date published updated" datetime="<?= $row->tanggal_up_berita ?>"><?= tanggal_indo2($row->tanggal_up_berita) ?></time>
										</a>
									</span>
									<?php if($row->views_berita > 0): ?>
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
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div id="comments" class="comments-area">
			<?php if($komentar > 0): ?>
				<h3 class="comments-title">
					<?= $komentar ?> komentar pada “<span><?= $title ?></span>”		
				</h3>
			<?php endif; ?>
			<ul class="comment-list">
				<?php 
				foreach ($data_komentar->result() as $row):
					$q_author = $this->db->get_where('tb_users', array('email' => $row->email_komentar, 'id' => $row->id_author_berita));
					$data_users = $q_author->row();
					if ($q_author->num_rows() > 0 && !empty($data_users->foto) && file_exists('uploads/users/'.$data_users->foto)) {
						$link_foto = base_url('uploads/users/'.$data_users->foto);
					}else{
						$link_foto = get_gravatar($row->email_komentar);
					}

					if ($id_author == $row->id_author_berita && $q_author->num_rows() > 0) {
						$liClass = "comment byuser comment-author-$username bypostauthor even thread-even";
						$komentator = '<a href="'.site_url('author/'.$username).'" rel="external nofollow ugc" class="url">'.$author.'</a><span>Penulis Pos</span>';
						$namaKomentator = $author;
					}else{
						$liClass = "comment even";
						if (empty($row->website_komentar)) {
							$linkWebKomentator = "javascript:void(0)";
						}else{
							$linkWebKomentator = 'https://www.'.$row->website_komentar;
						}
						$komentator = '<a href="'.$linkWebKomentator.'" rel="external nofollow ugc" class="url">'.$row->nama_komentar.'</a>';
						$namaKomentator = $row->nama_komentar;
					}
					?>
					<li class="<?= $liClass ?> depth-<?= $row->id_komentar ?>" id="li-comment-<?= $row->id_komentar ?>">
						<article id="comment-<?= $row->id_komentar ?>" class="comment">
							<header class="comment-meta comment-author vcard">
								<img alt="<?= $namaKomentator ?>" src="<?= $link_foto ?>" srcset="<?= $link_foto ?> 2x" class="avatar avatar-74 photo" height="74" width="74" loading="lazy">
								<div class="comment-author-link">
									<i class="fa fa-user"></i>
									<?= $komentator ?>
								</div>
								<div class="comment-date-time">
									<i class="fa fa-calendar-o"></i><?= tanggal_indo2($row->tanggal_komentar) ?> pada <?= hanya_jam($row->tanggal_komentar) ?>
								</div>
								<a class="comment-permalink" href="<?= site_url('berita/'.$slug) ?>#comment-<?= $row->id_komentar ?>">
									<i class="fa fa-link"></i>Permalink
								</a>						
							</header>


							<section class="comment-content comment">
								<p><?= nl2br($row->konten_komentar) ?></p>
								<a rel="nofollow" class="comment-reply-link" href="<?= site_url('berita/'.$slug) ?>/?replytocom=<?= $row->id_komentar ?>#respond" data-commentid="<?= $row->id_komentar ?>" data-postid="<?= $id_berita; ?>" data-belowelement="comment-<?= $row->id_komentar ?>" data-respondelement="respond" data-replyto="Balasan untuk <?= $namaKomentator ?>" aria-label="Balasan untuk <?= $namaKomentator ?>" title="Balasan untuk <?= $namaKomentator ?>">Balas</a>
							</section>
						</article>						
						<?php 
						$id_komentar = $row->id_komentar;
						$query = $this->db->query("SELECT * FROM tb_komentar WHERE status_komentar = 1 AND parent_komentar = '$id_komentar' ORDER BY id_komentar DESC");
						foreach($query->result() as $rowBal):
							$q_author2 = $this->db->get_where('tb_users', array('email' => $rowBal->email_komentar, 'id' => $rowBal->id_author_berita));
							$data_users2 = $q_author2->row();
							if ($q_author2->num_rows() > 0 && !empty($data_users2->foto) && file_exists('uploads/users/'.$data_users2->foto)) {
								$link_foto = base_url('uploads/users/'.$data_users2->foto);
							}else{
								$link_foto = get_gravatar($rowBal->email_komentar);
							}

							if ($id_author == $rowBal->id_author_berita && $q_author2->num_rows() > 0) {
								$liClass = "comment byuser comment-author-$username bypostauthor even thread-even";
								$komentator = '<a href="'.site_url('author/'.$username).'" rel="external nofollow ugc" class="url">'.$author.'</a><span>Penulis Pos</span>';
								$namaKomentator = $author;
							}else{
								$liClass = "comment even";
								if (!empty($rowBal->website_komentar)) {
									$linkWebKomentator = $rowBal->website_komentar;
								}else{
									$linkWebKomentator = "javascript:void(0)";
								}
								$komentator = '<a href="'.$linkWebKomentator.'" rel="external nofollow ugc" class="url">'.$rowBal->nama_komentar.'</a>';
								$namaKomentator = $rowBal->nama_komentar;
							}
							?>
							<ul class="children">
								<li class="<?= $liClass ?> depth-<?= $rowBal->id_komentar ?>" id="li-comment-<?= $rowBal->id_komentar ?>">
									<article id="comment-<?= $rowBal->id_komentar ?>" class="comment">
										<header class="comment-meta comment-author vcard">
											<img alt="<?= $namaKomentator ?>" src="<?= $link_foto ?>" srcset="<?= $link_foto ?> 2x" class="avatar avatar-74 photo" height="74" width="74" loading="lazy">
											<div class="comment-author-link">
												<i class="fa fa-user"></i>
												<?= $komentator ?>
											</div>
											<div class="comment-date-time">
												<i class="fa fa-calendar-o"></i><?= tanggal_indo2($rowBal->tanggal_komentar) ?> pada <?= hanya_jam($rowBal->tanggal_komentar) ?>
											</div>
											<a class="comment-permalink" href="<?= site_url('berita/'.$slug) ?>#comment-<?= $rowBal->id_komentar ?>">
												<i class="fa fa-link"></i>Permalink
											</a>						
										</header>


										<section class="comment-content comment">
											<p><?= nl2br($rowBal->konten_komentar) ?></p>
											<a rel="nofollow" class="comment-reply-link" href="<?= site_url('berita/'.$slug) ?>/?replytocom=<?= $rowBal->id_komentar ?>#respond" data-commentid="<?= $rowBal->id_komentar ?>" data-postid="<?= $id_berita; ?>" data-belowelement="comment-<?= $rowBal->id_komentar ?>" data-respondelement="respond" data-replyto="Balasan untuk <?= $namaKomentator ?>" aria-label="Balasan untuk <?= $namaKomentator ?>" title="Balasan untuk <?= $namaKomentator ?>">Balas</a>
										</section>
									</article>
									<?php 
									$id_komentar = $rowBal->id_komentar;
									$query = $this->db->query("SELECT * FROM tb_komentar WHERE status_komentar = 1 AND parent_komentar = '$id_komentar' ORDER BY id_komentar DESC");
									foreach($query->result() as $rowTri):
										$q_author3 = $this->db->get_where('tb_users', array('email' => $rowTri->email_komentar, 'id' => $rowTri->id_author_berita));
										$data_users3 = $q_author3->row();
										if ($q_author3->num_rows() > 0 && !empty($data_users3->foto) && file_exists('uploads/users/'.$data_users3->foto)) {
											$link_foto = base_url('uploads/users/'.$data_users3->foto);
										}else{
											$link_foto = get_gravatar($rowTri->email_komentar);
										}

										if ($id_author == $rowTri->id_author_berita && $q_author3->num_rows() > 0) {
											$liClass = "comment byuser comment-author-$username bypostauthor even thread-even";
											$komentator = '<a href="'.site_url('author/'.$username).'" rel="external nofollow ugc" class="url">'.$author.'</a><span>Penulis Pos</span>';
											$namaKomentator = $author;
										}else{
											$liClass = "comment even";
											if (!empty($rowTri->website_komentar)) {
												$linkWebKomentator = $rowTri->website_komentar;
											}else{
												$linkWebKomentator = "javascript:void(0)";
											}
											$komentator = '<a href="'.$linkWebKomentator.'" rel="external nofollow ugc" class="url">'.$rowTri->nama_komentar.'</a>';
											$namaKomentator = $rowTri->nama_komentar;
										}
										?>
										<ul class="children">
											<li class="<?= $liClass ?> depth-<?= $rowTri->id_komentar ?>" id="li-comment-<?= $rowTri->id_komentar ?>">
												<article id="comment-<?= $rowTri->id_komentar ?>" class="comment">
													<header class="comment-meta comment-author vcard">
														<img alt="<?= $namaKomentator ?>" src="<?= $link_foto ?>" srcset="<?= $link_foto ?> 2x" class="avatar avatar-74 photo" height="74" width="74" loading="lazy">
														<div class="comment-author-link">
															<i class="fa fa-user"></i>
															<?= $komentator ?>
														</div>
														<div class="comment-date-time">
															<i class="fa fa-calendar-o"></i><?= tanggal_indo2($rowTri->tanggal_komentar) ?> pada <?= hanya_jam($rowTri->tanggal_komentar) ?>
														</div>
														<a class="comment-permalink" href="<?= site_url('berita/'.$slug) ?>#comment-<?= $rowTri->id_komentar ?>">
															<i class="fa fa-link"></i>Permalink
														</a>						
													</header>


													<section class="comment-content comment">
														<p><?= nl2br($rowTri->konten_komentar) ?></p>
													</section>
												</article>
											</li>
										</ul>
										<?php 
									endforeach;
									?>
								</li>
							</ul>
							<?php 
						endforeach;
						?>
					</li>
					<?php 
				endforeach;
				?>
			</ul>
			<div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title">Tinggalkan Balasan 
					<small>
						<a rel="nofollow" id="cancel-comment-reply-link" href="<?= $slug ?>/#respond" style="display: none;">Batalkan balasan</a>
					</small>
				</h3>
				<form action="<?= site_url('kirim-komentar') ?>" method="post" id="commentform" class="comment-form" method="POST">
					<p class="comment-notes">
						<span id="email-notes">Alamat email Anda tidak akan dipublikasikan.</span> Ruas yang wajib diisi, ditandai dengan <span class="required">*</span>
					</p>
					<p class="comment-form-comment">
						<label for="comment">Komentar</label>
						<?= form_error('konten_komentar'); ?>
						<textarea id="comment" name="konten_komentar" cols="45" rows="8" maxlength="65525" required="required"><?= set_value('konten_komentar') ?></textarea>
					</p>
					<p class="comment-form-author">
						<label for="author">Nama <span class="required">*</span></label>
						<?= form_error('nama_komentar'); ?>
						<input id="author" name="nama_komentar" type="text" value="<?= set_value('nama_komentar'); ?>" size="30" maxlength="245" required="required">
					</p>
					<p class="comment-form-email">
						<label for="email">Email <span class="required">*</span></label>
						<?= form_error('email_komentar'); ?>
						<input id="email" name="email_komentar" type="email" value="<?= set_value('email_komentar'); ?>" size="30" maxlength="100" aria-describedby="email-notes" required="required">
					</p>
					<p class="comment-form-url">
						<label for="url">Situs Web</label>
						<input id="url" name="website" type="url" value="<?= set_value('website'); ?>" size="30" maxlength="200">
					</p>
					<p class="form-submit">
						<input name="submit" type="submit" id="submit" class="submit" value="Kirim Komentar">
						<input type="hidden" name="id_komentar_berita" value="<?= $id_berita ?>" id="comment_post_ID" required>
						<input type="hidden" name="id_komentar" id="comment_parent" value="0" required>
						<input type="hidden" name="slug" value="<?= $slug ?>">
						<input type="hidden" name="id_author_berita" value="<?= $id_author ?>">
					</p>
				</form>
			</div>

		</div>

		<script type="text/javascript">
			function openSocialShare(url){
				window.open(url,'sharer','toolbar=0,status=0,width=900,height=695');
				return true;				
			}
		</script>
	</div>
</div>