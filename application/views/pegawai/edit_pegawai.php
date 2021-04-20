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
                        <div class="col-sm-12">
					       <a style="float: right;" href="<?= base_url('Pegawai') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
					    </div>
						<div class="col-md-5">
							<?php
							echo validation_errors('<div class="alert alert-warning">', '</div>');

							//error
							if (isset($error)) {
								echo '<div class="alert alert-warning">';
								echo $error;
								echo '</div>';
							}

							echo form_open_multipart(base_url('Pegawai/edit_pegawai/' . $detail->id_pegawai));
							?>

							
							<div class="form-group">
								<label for="NIK">NIK</label>
								<input requred="" type="text" name="NIK" class="form-control <?php echo form_error('NIK') ? 'is-invalid' : '' ?>" placeholder="NIK" value="<?php echo $detail->NIK ?>">
								<div class="invalid-feedback">
									<?php echo form_error('NIK') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_pegawai">Nama Pegawai</label>
								<input requred="" type="text" name="nama_pegawai" class="form-control <?php echo form_error('nama_pegawai') ? 'is-invalid' : '' ?>" placeholder="Nama Pegawai" value="<?php echo $detail->nama_pegawai ?>">
								<div class="invalid-feedback">
									<?php echo form_error('nama_pegawai') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<input requred="" type="text" name="alamat" class="form-control <?php echo form_error('alamat') ? 'is-invalid' : '' ?>" placeholder="Alamat" value="<?php echo $detail->alamat ?>">
								<div class="invalid-feedback">
									<?php echo form_error('alamat') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="no_hp">Nomor HP</label>
								<input requred="" type="text" name="no_hp" class="form-control <?php echo form_error('no_hp') ? 'is-invalid' : '' ?>" placeholder="Nomor HP" value="<?php echo $detail->no_hp ?>">
								<div class="invalid-feedback">
									<?php echo form_error('no_hp') ?>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<!-- <div class="form-group">
								<label for="password">Password</label>
								<input type="Password" name="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" placeholder="Password" value="<?php echo $detail->pass ?>">
								<div class="invalid-feedback">
									<?php echo form_error('password') ?>
								</div>
							</div> -->
							<div class="form-group">
								<label for="username">username</label>
								<input requred="" type="text" name="username" class="form-control <?php echo form_error('username') ? 'is-invalid' : '' ?>" placeholder="username" value="<?php echo $detail->username ?>">
								<div class="invalid-feedback">
									<?php echo form_error('username') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="id_status">Status</label>
								<select class="form-control" id="id_status" name="id_status">
									<?php foreach ($tb_status as $rows) : ?>
										<option value="<?= $rows->id_status; ?>" <?php if ($detail->id_status == $rows->id_status) {
																							echo "selected";
																						} ?>>
											<?= $rows->nama_status; ?>
										</option> <?php endforeach; ?>
								</select>
							</div>
							<!--  <div class="form-group">
								<label for="isactive">Akun Aktif ?</label>
								<input type="text" name="isactive" class="form-control <?php echo form_error('isactive') ? 'is-invalid' : '' ?>" value="<?php echo $detail->isactive ?>">
								<div class="invalid-feedback">
									<?php echo form_error('isactive') ?>
								</div>
							</div> -->
							<div class="form-group">
								<label>Foto</label><br>
								<small class="text-muted">Kosongkan jika tidak ingin ubah foto</small><br>
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