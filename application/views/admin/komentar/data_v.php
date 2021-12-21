<!-- <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/komentar.css') ?>"> -->
<div class="page-header">
	<h1>
		<?= $bc_aktif; ?>
		<?php if (isset($sm_text)): ?>
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				<?= $sm_text; ?>
			</small>			
		<?php endif ?>
	</h1>

</div>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<?php 
		foreach ($komentar->result() as $row):
			$q_author = $this->db->get_where('tb_users', array('email' => $row->email_komentar));
			$data_Users = $q_author->row();
			if ($q_author->num_rows() > 0 && !empty($data_Users->foto) && file_exists('uploads/Users/'.$data_Users->foto)) {
				$link_foto = base_url('uploads/Users/'.$data_Users->foto);
			}else{
				$link_foto = get_gravatar($row->email_komentar);
			}
			?>
			<div class="timeline-container">
				<div class="timeline-label">
					<a style="text-decoration: none;" href="<?= site_url('berita/'.$row->slug_berita) ?>" target="_blank">
						<span class="label arrowed-in-right label-lg">							
							<?= $row->judul_berita ?>
						</span>
					</a>
				</div>
				<div class="timeline-items">
					<div class="timeline-item clearfix">
						<div class="timeline-info">
							<img alt="<?= $row->nama_komentar ?>" src="<?= $link_foto ?>">
							<span class="label label-info label-sm"><?= hanya_jam($row->tanggal_komentar) ?></span>
						</div>
						<div class="widget-box transparent">
							<div class="widget-header widget-header-small">
								<h4 class="widget-title smaller">
									<?= $row->nama_komentar ?>
								</h4>
								<?php if ($row->dibaca == 1): ?>
									<span class="widget-toolbar">
										<i class="ace-icon fa fa- fa-bell-o bigger-110"></i>
										Telah dibalas
									</span>
								<?php endif ?>
								<span class="widget-toolbar">
									<i class="ace-icon fa fa-clock-o bigger-110"></i>
									<?= waktu_berlalu($row->tanggal_komentar) ?>
								</span>
								<span class="widget-toolbar">
									<i class="fa fa-calendar"></i> <?= tanggal_indo($row->tanggal_komentar) ?>
								</span>
								<span class="widget-toolbar">
									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-up"></i>
									</a>
								</span>
							</div>
							<div class="widget-body">
								<div class="widget-main">
									<p>
										<?= nl2br($row->konten_komentar) ?>
									</p>
									<div class="space-6"></div>
									<div class="widget-toolbox clearfix">
										<?php if (!empty($row->website_komentar)): ?>
											<div class="pull-left">
												<a target="_blank" href="<?= $row->website_komentar ?>" style="text-decoration: none;">
													<i class="ace-icon fa fa-globe grey bigger-125"></i> 
													<?= $row->website_komentar ?>
												</a>
											</div>											
										<?php endif ?>
										<div class="pull-right action-buttons">
											<a data-id_komentar="<?= $row->id_komentar ?>" data-id_komentar_berita="<?= $row->id_komentar_berita ?>" data-konten_komentar="<?= $row->konten_komentar ?>" href="javascript:void(0)" title="Balas" class="tombol-balas">
												<i class="ace-icon fa fa-reply green bigger-130"></i>
											</a>
											<a data-id_komentar="<?= $row->id_komentar ?>" data-konten_komentar="<?= $row->konten_komentar ?>" data-website="<?= $row->website_komentar ?>" href="javascript:void(0)" title="Edit" class="tombol-edit">
												<i class="ace-icon fa fa-pencil blue bigger-125"></i>
											</a>
											<?php 
											$cekParent = $this->db->query("SELECT * FROM tb_komentar WHERE parent_komentar = '$row->id_komentar'");
											$jumlah = $cekParent->num_rows();
											if ($jumlah <= 0):
												?>
												<a href="<?= site_url('admin/komentar/hapus/'.$row->id_komentar) ?>" title="Hapus" class="tombol-hapus">
													<i class="ace-icon fa fa-times red bigger-125"></i>
												</a>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="space-6"></div>
								<?php 
								$id_komentar = $row->id_komentar;
								$query = $this->db->query("SELECT * FROM tb_komentar WHERE status_komentar = 1 AND parent_komentar = '$id_komentar' ORDER BY id_komentar DESC");
								foreach($query->result() as $rowBal):
									$q_author2 = $this->db->get_where('tb_users', array('email' => $rowBal->email_komentar));
									$data_Users2 = $q_author2->row();
									if ($q_author2->num_rows() > 0 && !empty($data_Users2->foto) && file_exists('uploads/Users/'.$data_Users2->foto)) {
										$link_foto = base_url('uploads/Users/'.$data_Users2->foto);
									}else{
										$link_foto = get_gravatar($rowBal->email_komentar);
									}
									?>
									<div class="timeline-items">
										<div class="timeline-item clearfix">
											<div class="timeline-info">
												<img alt="<?= $rowBal->nama_komentar ?>" src="<?= $link_foto ?>">
												<span class="label label-info label-sm"><?= hanya_jam($rowBal->tanggal_komentar) ?></span>
											</div>
											<div class="widget-box transparent">
												<div class="widget-header widget-header-small">
													<h4 class="widget-title smaller">
														<?= $rowBal->nama_komentar ?>
													</h4>
													<?php if ($rowBal->dibaca == 1): ?>
														<span class="widget-toolbar">
															<i class="ace-icon fa fa- fa-bell-o bigger-110"></i>
															Telah dibalas
														</span>
													<?php endif ?>
													<span class="widget-toolbar">
														<i class="ace-icon fa fa-clock-o bigger-110"></i>
														<?= waktu_berlalu($rowBal->tanggal_komentar) ?>
													</span>
													<span class="widget-toolbar">
														<i class="fa fa-calendar"></i> <?= tanggal_indo($rowBal->tanggal_komentar) ?>
													</span>
													<span class="widget-toolbar">
														<a href="#" data-action="collapse">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>
													</span>
												</div>
												<div class="widget-body">									
													<div class="widget-main">
														<p>
															<?= nl2br($rowBal->konten_komentar) ?>
														</p>
														<div class="space-6"></div>
														<div class="widget-toolbox clearfix">
															<?php if (!empty($rowBal->website_komentar)): ?>
																<div class="pull-left">
																	<a target="_blank" href="<?= $rowBal->website_komentar ?>" style="text-decoration: none;">
																		<i class="ace-icon fa fa-globe grey bigger-125"></i> 
																		<?= $rowBal->website_komentar ?>
																	</a>
																</div>											
															<?php endif ?>
															<div class="pull-right action-buttons">
																<a data-id_komentar="<?= $rowBal->id_komentar ?>" data-id_komentar_berita="<?= $rowBal->id_komentar_berita ?>" data-konten_komentar="<?= $rowBal->konten_komentar ?>" href="javascript:void(0)" title="Balas" class="tombol-balas">
																	<i class="ace-icon fa fa-reply green bigger-130"></i>
																</a>
																<a data-id_komentar="<?= $rowBal->id_komentar ?>" data-konten_komentar="<?= $rowBal->konten_komentar ?>" data-website="<?= $rowBal->website_komentar ?>" href="javascript:void(0)" title="Edit" class="tombol-edit">
																	<i class="ace-icon fa fa-pencil blue bigger-125"></i>
																</a>
																<?php 
																$cekParent = $this->db->query("SELECT * FROM tb_komentar WHERE parent_komentar = '$rowBal->id_komentar'");
																$jumlah = $cekParent->num_rows();
																if ($jumlah <= 0):
																	?>
																	<a href="<?= site_url('admin/komentar/hapus/'.$rowBal->id_komentar) ?>" title="Hapus" class="tombol-hapus">
																		<i class="ace-icon fa fa-times red bigger-125"></i>
																	</a>
																<?php endif; ?>
															</div>
														</div>
														<div class="space-6"></div>
														<?php 
														$id_komentar = $rowBal->id_komentar;
														$query = $this->db->query("SELECT * FROM tb_komentar WHERE status_komentar = 1 AND parent_komentar = '$id_komentar' ORDER BY id_komentar DESC");
														foreach($query->result() as $rowTri):
															$q_author3 = $this->db->get_where('tb_users', array('email' => $rowTri->email_komentar));
															$data_Users3 = $q_author3->row();
															if ($q_author3->num_rows() > 0 && !empty($data_Users3->foto) && file_exists('uploads/Users/'.$data_Users3->foto)) {
																$link_foto = base_url('uploads/Users/'.$data_Users3->foto);
															}else{
																$link_foto = get_gravatar($rowTri->email_komentar);
															}
															?>
															<div class="timeline-items">
																<div class="timeline-item clearfix">
																	<div class="timeline-info">
																		<img alt="<?= $rowTri->nama_komentar ?>" src="<?= $link_foto ?>">
																		<span class="label label-info label-sm"><?= hanya_jam($rowTri->tanggal_komentar) ?></span>
																	</div>
																	<div class="widget-box transparent">
																		<div class="widget-header widget-header-small">
																			<h4 class="widget-title smaller">
																				<?= $rowTri->nama_komentar ?>
																			</h4>
																			<?php if ($rowTri->dibaca == 1): ?>
																				<span class="widget-toolbar">
																					<i class="ace-icon fa fa- fa-bell-o bigger-110"></i>
																					Telah dibalas
																				</span>
																			<?php endif ?>
																			<span class="widget-toolbar">
																				<i class="ace-icon fa fa-clock-o bigger-110"></i>
																				<?= waktu_berlalu($rowTri->tanggal_komentar) ?>
																			</span>
																			<span class="widget-toolbar">
																				<i class="fa fa-calendar"></i> <?= tanggal_indo($rowTri->tanggal_komentar) ?>
																			</span>
																			<span class="widget-toolbar">
																				<a href="#" data-action="collapse">
																					<i class="ace-icon fa fa-chevron-up"></i>
																				</a>
																			</span>
																		</div>
																		<div class="widget-body">									
																			<div class="widget-main">
																				<p>
																					<?= nl2br($rowTri->konten_komentar) ?>
																				</p>
																				<div class="space-6"></div>
																				<div class="widget-toolbox clearfix">
																					<?php if (!empty($rowTri->website_komentar)): ?>
																						<div class="pull-left">
																							<a target="_blank" href="<?= $rowTri->website_komentar ?>" style="text-decoration: none;">
																								<i class="ace-icon fa fa-globe grey bigger-125"></i> 
																								<?= $rowTri->website_komentar ?>
																							</a>
																						</div>											
																					<?php endif ?>
																					<div class="pull-right action-buttons">
																						<a data-id_komentar="<?= $rowTri->id_komentar ?>" data-konten_komentar="<?= $rowTri->konten_komentar ?>" data-website="<?= $rowTri->website_komentar ?>" href="javascript:void(0)" title="Edit" class="tombol-edit">
																							<i class="ace-icon fa fa-pencil blue bigger-125"></i>
																						</a>
																						<a href="<?= site_url('admin/komentar/hapus/'.$rowTri->id_komentar) ?>" title="Hapus" class="tombol-hapus">
																							<i class="ace-icon fa fa-times red bigger-125"></i>
																						</a>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														<?php endforeach; ?>
													</div>
												</div>											
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div><!-- /.timeline-items -->
			</div>
		<?php endforeach; ?>
		<?php if ($pagination >= $limit_post): ?>
			<div class="text-center">
				<?= $pagination ?>
			</div>				
		<?php endif ?>
	</div>

</div>
<!-- modal balas -->

<div class="modal fade" id="modalBalas" tabindex="-1" role="dialog" aria-labelledby="modalBalas" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Balas Komentar</h4>
			</div>
			<form method="post" action="<?=site_url('admin/komentar/balas')?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="komentar_sebelumnya">Komentar</label>
						<p id="komentar_sebelumnya"></p>
					</div>
					<div class="form-group">
						<label for="website_balas">Website</label>
						<input type="text" name="website_komentar" class="form-control" id="website_balas" placeholder="Website (opsional)" autofocus />
					</div>
					<div class="form-group">
						<label for="konten_balas">Komentar Balasan</label>
						<textarea name="konten_komentar" rows="10" id="konten_balas" required class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_kom_balas" required>
					<input type="hidden" name="id_komar_blas" required>
					<input type="hidden" name="id_author" value="<?= $id ?>" required>
					<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup <i class="fa fa-fw fa-remove"></i></button>
				</div>
			</form>
		</div>
	</div>

</div>
<!-- modal edit -->

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Edit Komentar</h4>
			</div>
			<form method="post" action="<?=site_url('admin/komentar/update')?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="website_komentar">Website</label>
						<input type="text" name="website_komentar" class="form-control" id="website_komentar" placeholder="Website (opsional)" autofocus />
					</div>
					<div class="form-group">
						<label for="konten_komentar">Komentar</label>
						<textarea name="konten_komentar" rows="10" id="konten_komentar" required class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_komentar" required>
					<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup <i class="fa fa-fw fa-remove"></i></button>
				</div>
			</form>
		</div>
	</div>

</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.tombol-edit').on('click', function() {
			var id_komentar = $(this).data('id_komentar');
			var isi 		= $(this).data('konten_komentar');
			var website 	= $(this).data('website');
			$('#modalEdit').modal('show');
			$('[name="id_komentar"]').val(id_komentar);
			$('#konten_komentar').val(isi);
			$('#website_komentar').val(website);
		})
		$('.tombol-balas').on('click', function() {
			var id_komentar 		= $(this).data('id_komentar');
			var id_komentar_berita = $(this).data('id_komentar_berita');
			var isi 				= $(this).data('konten_komentar');
			$('#modalBalas').modal('show');
			$('[name="id_kom_balas"]').val(id_komentar);
			$('[name="id_komar_blas"]').val(id_komentar_berita);
			$('#komentar_sebelumnya').html('"'+isi+'"');
		})
	});

</script>