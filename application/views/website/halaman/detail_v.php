
<div id="primary">
	<div id="content" class="clearfix">		
		<article id="post-285" class="post-285 page type-page status-publish hentry">
			<header class="entry-header">
				<h1 class="entry-title"><?= $title ?></h1>
			</header>

			<div class="entry-content clearfix">
				<?= $konten ?>
				<p></p>
			</div>

			<div class="entry-footer"></div>

		</article>

		<div class="pgntn-page-pagination pgntn-bottom">
			<div class="pgntn-page-pagination-block">
				<div class="pgntn-page-pagination-intro">Share via :</div>
				<a rel="nofollow" class="page-numbers" title="LinkedIn" href="javascript:void(0)" onclick="javascript:openSocialShare('https://www.linkedin.com/shareArticle?mini=true&url=<?= site_url("halaman/".$slug) ?>');"><i class="fa fa-linkedin"></i></a>
				<a rel="nofollow" class="page-numbers" title="Gmail" href="javascript:void(0)" onclick="javascript:openSocialShare('https://mail.google.com/mail/u/0/?ui=2&view=cm&fs=1&tf=1&su=<?= $title ?>&body=<?= site_url("halaman/".$slug) ?>');"><i class="fa fa-envelope"></i></a>
				<a rel="nofollow" class="page-numbers" title="Twitter" href="javascript:void(0)" onclick="javascript:openSocialShare('http://twitter.com/share?text=<?=$title?>&url=<?=site_url("halaman/".$slug)?>')"><i class="fa fa-twitter"></i></a>
				<a rel="nofollow" class="page-numbers" title="Facebook" href="javascript:void(0)" onclick="javascript:openSocialShare('https://www.facebook.com/sharer.php?u=<?= site_url("halaman/".$slug) ?>');"><i class="fa fa-facebook"></i></a>
				<a rel="nofollow" class="page-numbers" title="Telegram" href="javascript:void(0)" onclick="javascript:openSocialShare('https://telegram.me/share/url?url=<?= site_url("halaman/".$slug) ?>');"><i class="fa fa-telegram"></i></a>
				<a rel="nofollow" class="page-numbers" title="WhatsApp" href="javascript:void(0)" onclick="javascript:openSocialShare('https://wa.me/?text=<?= $title.' | '.site_url("halaman/".$slug) ?>')" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>		
			</div>
			<div class="clear"></div>
		</div>
	</div>

	<script type="text/javascript">
		function openSocialShare(url){
			window.open(url,'sharer','toolbar=0,status=0,width=900,height=695');
			return true;				
		}
	</script>
</div>