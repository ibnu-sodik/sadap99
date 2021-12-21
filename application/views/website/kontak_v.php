<?php 
$data = $data_konten->row();
?>
<link rel='stylesheet' id='everest-forms-general-css'  href='<?= base_url() ?>assets/everest-form/everest-forms.css' type='text/css' media='all' />
<div id="primary">
	<div id="content" class="clearfix">		
		<article id="post-285" class="post-285 page type-page status-publish hentry">
			<header class="entry-header">
				<h1 class="entry-title"><?= $title ?></h1>
			</header>

			<div class="entry-content clearfix">
				<?= $data->konten_kontak ?>
				<div class="everest-forms">
					<div class="evf-container default" id="evf-287">
						<form id="evf-form-287" class="everest-form" data-formid="287" data-ajax_submission="0" method="post" enctype="multipart/form-data" action="<?= $form_action ?>" novalidate="novalidate">
							<div class="evf-field-container">
								<div class="evf-frontend-row" data-row="row_1">
									<div class="evf-frontend-grid evf-grid-1" data-grid="grid_1">
										<div id="nama-container" class="evf-field evf-field-text form-row validate-required" data-required-field-message="This field is required." data-field-id="lVizlNhYus-1">
											<label class="evf-field-label" for="nama">
												<span class="evf-label">Nama</span>
												<abbr class="required" title="Required">*</abbr>
											</label>
											<input type="text" id="nama" class="input-text" name="nama" value="<?= set_value('nama') ?>">
											<?= form_error('nama') ?>
										</div>
										<div id="email-container" class="evf-field evf-field-email form-row validate-required validate-email" data-required-field-message="Please enter a valid email address." data-field-id="XYnMdkQDKM-3">
											<label class="evf-field-label" for="email">
												<span class="evf-label">Email</span>
												<abbr class="required" title="Required">*</abbr>
											</label>
											<input type="email" id="email" class="input-text" name="email" value="<?= set_value('email') ?>">
											<?= form_error('email') ?>
										</div>
										<div id="subjek-container" class="evf-field evf-field-text form-row validate-required" data-required-field-message="This field is required." data-field-id="xJivsqAS2c-2">
											<label class="evf-field-label" for="subjek">
												<span class="evf-label">Subjek</span>
												<abbr class="required" title="Required">*</abbr>
											</label>
											<input type="text" id="subjek" class="input-text" name="subjek">
											<?= form_error('subjek') ?>
										</div>
										<div id="pesan-container" class="evf-field evf-field-textarea form-row" data-field-id="YalaPcQ0DO-4">
											<label class="evf-field-label" for="pesan">
												<span class="evf-label">Pesan</span> 
												<abbr class="required" title="Required">*</abbr>
											</label>
											<textarea id="pesan" class="input-text" name="pesan"><?= set_value('pesan') ?></textarea>
											<?= form_error('pesan') ?>
										</div>
									</div>
								</div>
							</div>
							<div class="evf-submit-container ">
								<button type="submit" name="submit" class="everest-forms-submit-button button evf-submit " id="evf-submit-287" value="evf-submit" data-process-text="Processing…" conditional_rules="&quot;&quot;" conditional_id="evf-submit-287">Kirim</button>
							</div>
						</form>
					</div>
				</div>
				<p></p>
			</div>

			<div class="entry-footer"></div>

		</article>
	</div>
</div>