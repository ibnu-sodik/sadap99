<?php $row = $data->row(); ?>
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
	<div class="col-md-6">
		<form class="form-horizontal" role="form" method="post" action="<?= $form_action.'/'.$row->id ?>">
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="full_name"> Nama Lengkap </label>

				<div class="col-sm-9">
					<input type="text" id="full_name" name="full_name" placeholder="Nama Lengkap" class="form-control"  value="<?= $row->full_name ?>"/>
					<?php echo form_error('full_name') ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="username"> Username </label>

				<div class="col-sm-9">
					<input type="text" id="username" name="username" placeholder="Username" class="form-control"  value="<?= $row->username ?>"/>
					<?php echo form_error('username') ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="email"> Alamat Email </label>

				<div class="col-sm-9">
					<input type="email" id="email" name="email" placeholder="Alamat Email" class="form-control"  value="<?= $row->email ?>"/>
					<?php echo form_error('email') ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="jenis_fungsi"> Fungsi/ Jabatan </label>

				<div class="col-sm-9">
					<input type="text" id="jenis_fungsi" name="jenis_fungsi" placeholder="Fungsi/ Jabatan" class="form-control"  value="<?= $row->jenis_fungsi ?>"/>
					<?php echo form_error('jenis_fungsi') ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="level"> Hak Akses </label>

				<div class="col-sm-9">
					<select name="level" class="form-control" id="level">
						<option value="">--- Pilih Hak Akses ---</option>
						<?php 
						$pilihan = array('1' => 'Administrator', '2' => 'User');
						foreach ($pilihan as $key => $value) {
							if ($row->level == $key) {
								$cek = "selected";
							}else{
								$cek = "";
							}
							echo "<option value=".$key." ".$cek.">".$value."</option>";
						}
						?>
					</select>
					<?php echo form_error('level') ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right"></label>
				<div class="col-sm-9">
					<button class="btn-block btn btn-primary">Simpan <i class="fa fa-send"></i></button>
				</div>
			</div>
		</form>
	</div>
</div>