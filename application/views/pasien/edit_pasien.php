<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2><?= $title ?></h2>
							<div class="clearfix"></div>
							<?php if ($this->session->flashdata('failed')) : ?>
								<div class="alert alert-danger alert-dismissible" role="alert">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<?php echo $this->session->flashdata('failed'); ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-sm-12">
							<a style="float: right;" href="<?= base_url('Pasien') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
						</div>
						<?php
						foreach ($tb_pasien as $u) {
							echo form_open_multipart('Pasien/update');
						?>
							<div class="col-md-6">
								<script type="text/javascript" src="<?php echo base_url() ?>vendors/jquery/dist/jquery.js"></script>
								<input class="hidden" type="text" name="no_rm" class="form-control" placeholder="No RM" value="<?php echo $u->no_rm ?>" required>
								<div class="form-group ">
									<label for="no_rmbaru">No RM</label>
									<input type="text" name="no_rmbaru" class="form-control <?php echo form_error('no_rm') ? 'is-invalid' : '' ?>" placeholder="No RM" value="<?php echo $u->no_rm ?>" required>
									<small class="text-danger"><?= form_error('no_rm'); ?></small>
								</div>
								<div class="form-group">
									<label for="password">Password <span class="status lemah">lemah</span> </label>
									<input type="password" name="password" class="form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" placeholder="Password" autofocus id="password">
									<small class="text-danger"><?= form_error('password'); ?></small>
								</div>
								<div class="form-group ">
									<label for="nama_pasien">Nama Pasien</label>
									<input type="text" name="nama_pasien" class="form-control <?php echo form_error('nama_pasien') ? 'is-invalid' : '' ?>" placeholder="Nama Pasien" value="<?php echo $u->nama_pasien ?>" required>
									<small class="text-danger"><?= form_error('nama_pasien'); ?></small>
								</div>
								<div class="form-group">
									<label for="tgl_lahir">Tanggal Lahir</label>
									<small class="text-success"> * Klik Tanggalnya</small>
									<input type="text" autocomplete="off" name="tgl_lahir" class="form-control <?php echo form_error('tgl_lahir') ? 'is-invalid' : '' ?>" placeholder="MM/DD/YYYY" value="<?php echo $u->tgl_lahir ?>" id="lahir" required>
									<small class="text-danger"><?= form_error('tgl_lahir'); ?></small>
								</div>
								<div class="form-group">
									<label for="alamat">Alamat</label>
									<input type="text" name="alamat" class="form-control <?php echo form_error('alamat') ? 'is-invalid' : '' ?>" placeholder="Alamat" value="<?php echo $u->alamat ?>" required>
									<small class="text-danger"><?= form_error('alamat'); ?></small>
								</div>
								<div class="form-group">
									<label for="desa">Desa</label>
									<input type="text" name="desa" class="form-control <?php echo form_error('desa') ? 'is-invalid' : '' ?>" placeholder="Desa" value="<?php echo $u->desa ?>" required>
									<small class="text-danger"><?= form_error('desa'); ?></small>
								</div>
								<div class="form-group">
									<label for="kota">Kota</label>
									<input type="text" name="kota" class="form-control <?php echo form_error('kota') ? 'is-invalid' : '' ?>" placeholder="Kota" value="<?php echo $u->kota ?>" required>
									<small class="text-danger"><?= form_error('Kota'); ?></small>
								</div>
								<div class="form-group">
									<label for="nama_kk">Nama KK</label>
									<input type="text" name="nama_kk" class="form-control <?php echo form_error('nama_kk') ? 'is-invalid' : '' ?>" placeholder="Nama KK" value="<?php echo $u->nama_kk ?>" required>
									<small class="text-danger"><?= form_error('nama_kk'); ?></small>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="id_agama">Agama</label>
									<select class="form-control" id="id_agama" name="id_agama">
										<option selected disabled>Silahkan Pilih</option>
										<?php foreach ($tb_agama as $rows) : ?>
											<option value="<?= $rows->id_agama; ?>" <?php if ($u->id_agama == $rows->id_agama) {
																						echo "selected";
																					} ?>>
												<?= $rows->agama; ?>
											</option> <?php endforeach; ?>
									</select>
									<small class="text-danger"><?= form_error('id_agama'); ?></small>
								</div>
								<div class="form-group">
									<label for="id_pendidikan">Pendidikan</label>
									<select class="form-control" id="id_pendidikan" name="id_pendidikan">
										<option selected disabled>Silahkan Pilih</option>
										<?php foreach ($tb_pendidikan as $rows) : ?>
											<option value="<?= $rows->id_pendidikan; ?>" <?php if ($u->id_pendidikan == $rows->id_pendidikan) {
																								echo "selected";
																							} ?>>
												<?= $rows->pendidikan; ?>
											</option> <?php endforeach; ?>
									</select>
									<small class="text-danger"><?= form_error('id_pendidikan'); ?></small>
								</div>
								<div class="form-group">
									<label for="id_pekerjaan">Pekerjaan</label>
									<select class="form-control" id="id_pekerjaan" name="id_pekerjaan">
										<option selected disabled>Silahkan Pilih</option>
										<?php foreach ($tb_pekerjaan as $rows) : ?>
											<option value="<?= $rows->id_pekerjaan; ?>" <?php if ($u->id_pekerjaan == $rows->id_pekerjaan) {
																							echo "selected";
																						} ?>>
												<?= $rows->pekerjaan; ?>
											</option> <?php endforeach; ?>
									</select>
									<small class="text-danger"><?= form_error('id_pekerjaan'); ?></small>
								</div>
								<div class="form-group">
									<label for="id_jenis_kelamin">Jenis Kelamin</label>
									<select class="form-control" id="id_jenis_kelamin" name="id_jenis_kelamin">
										<option selected disabled>Silahkan Pilih</option>
										<?php foreach ($tb_jenis_kelamin as $rows) : ?>
											<option value="<?= $rows->id_jenis_kelamin; ?>" <?php if ($u->id_jenis_kelamin == $rows->id_jenis_kelamin) {
																								echo "selected";
																							} ?>>
												<?= $rows->jenis_kelamin; ?>
											</option> <?php endforeach; ?>
									</select>
									<small class="text-danger"><?= form_error('id_jenis_kelamin'); ?></small>
								</div>
								<div class="form-group">
									<label for="darah">Golongan Darah</label>
									<select class="form-control" name="darah">
										<option selected disabled>Silahkan Pilih</option>
										<option <?php if ($u->darah == 'A') {
													echo "selected";
												} ?>>A</option>
										<option <?php if ($u->darah == 'B') {
													echo "selected";
												} ?>>B</option>
										<option <?php if ($u->darah == 'O') {
													echo "selected";
												} ?>>O</option>
										<option <?php if ($u->darah == 'AB') {
													echo "selected";
												} ?>>AB</option>
									</select>
									<small class="text-danger"><?= form_error('darah'); ?></small>
								</div>
								<div class="form-group">
									<label for="no_hp">Nomor HP</label>
									<input type="text" name="no_hp" class="form-control <?php echo form_error('no_hp') ? 'is-invalid' : '' ?>" placeholder="Nomor HP" value="<?php echo $u->no_hp ?>">
									<small class="text-danger"><?= form_error('no_hp'); ?></small>
								</div>
								<div class="form-group">
									<label for="NIK">NIK</label>
									<input type="text" name="NIK" class="form-control <?php echo form_error('NIK') ? 'is-invalid' : '' ?>" placeholder="NIK" value="<?php echo $u->nik ?>">
									<small class="text-danger"><?= form_error('NIK'); ?></small><br>
									<input type="submit" class="btn btn-primary" value="Simpan">
								</div>
							</div>
						<?php
							echo form_close();
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>