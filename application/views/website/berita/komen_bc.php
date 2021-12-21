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
		<a class="comment-permalink" href="<?= site_url('berita/detail/'.$slug) ?>#comment-<?= $row->id_komentar ?>">
			<i class="fa fa-link"></i>Permalink
		</a>						
	</header>

	<section class="comment-content comment">
		<p><?= nl2br($row->konten_komentar) ?></p>
		<a rel="nofollow" class="comment-reply-link" href="javascript:void(0)" data-commentid="<?= $row->id_komentar ?>" data-postid="<?= $id_berita ?>" data-belowelement="comment-<?= $id_berita ?>" data-replyto="Balasan untuk <?= $namaKomentator ?>" aria-label="Balasan untuk <?= $namaKomentator ?>" title="Balasan untuk <?= $namaKomentator ?>">Balas</a>	
	</section>
</article>


<div id="respond" class="comment-respond">
	<h3 class="comment-reply-title">Tinggalkan Komentar</h3>
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
			<input type="hidden" name="id_author_berita" value="<?= $id_author ?>" id="comment_parent" value="0" required>
			<input type="hidden" name="slug" value="<?= $slug ?>">
		</p>
	</form>
</div>