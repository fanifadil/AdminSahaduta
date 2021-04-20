<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2><?= $title; ?></h2>
							<div class="clearfix"></div>
						</div>
						<?php
						echo validation_errors('<div class="alert alert-warning">', '</div>');

						//error
						if (isset($error)) {
							echo '<div class="alert alert-warning">';
							echo $error;
							echo '</div>';
						}


						echo form_open_multipart('Pegawai/add');
						?>

						<div class="col-sm-12">
				          <a style="float: right;" href="<?= base_url('Pegawai') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
				        </div>

						<div class="col-md-5">
							<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
							<link rel="stylesheet" type="text/css" href="build/custom.css">
							<script type="text/javascript" src="<?php echo base_url() ?>vendors/jquery/dist/jquery.js"></script>

							<div class="form-group">
								<label for="NIK">NIK</label>
								<input required="" type="text" name="NIK" class="form-control" placeholder="NIK" value="<?= set_value('NIK'); ?>" autocomplete="off">
								<div class="invalid-feedback">
									<?php echo form_error('NIK') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_pegawai">Nama Pegawai</label>
								<input required="" type="text" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai" value="<?= set_value('nama_pegawai'); ?>" autocomplete="off">
								<div class="invalid-feedback">
									<?php echo form_error('nama_pegawai') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<input required="" type="text" name="alamat" class="form-control" placeholder="Alamat" value="<?= set_value('alamat'); ?>" autocomplete="off">
								<div class="invalid-feedback">
									<?php echo form_error('alamat') ?>
								</div>
								<div class="form-group">
									<label for="no_hp">Nomor HP</label>
									<input required="" type="text" name="no_hp" class="form-control <?php echo form_error('no_hp') ? 'is-invalid' : '' ?>" placeholder="Nomor HP" value="<?= set_value('no_hp'); ?>" autocomplete="off">
									<div class="invalid-feedback">
										<?php echo form_error('no_hp') ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="username">Username</label>
								<input required="" type="text" name="username" class="form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>" placeholder="Username" value="<?= set_value('username'); ?>" autocomplete="off">
								<div class="invalid-feedback">
									<?php echo form_error('username') ?>
								</div>
							</div>

						</div>

						<div class="col-md-5">
							<div class="form-group">
								<label for="password">Password <span class="status lemah">lemah</span> </label>
								<input required type="password" name="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" placeholder="Password" id="password" autocomplete="off">
								<div class="invalid-feedback">
									<?php echo form_error('password') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="id_status">Status</label>
								<select class="form-control" id="id_status" name="id_status">
									<?php foreach ($tb_status as $rows) : ?>
										<option value="<?= $rows->id_status; ?>"><?= $rows->nama_status; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Foto</label>
								<input type="file" name="filefoto" class="form-control">
							</div><br>
							<input type="submit" class="btn btn-primary" value="Simpan">
						</div>
						<?php
						echo form_close();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>