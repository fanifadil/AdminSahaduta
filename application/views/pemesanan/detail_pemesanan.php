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
						<?php if ($this->session->flashdata('success')) : ?>
							<div class="alert alert-success alert-dismissible" role="alert">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?php echo $this->session->flashdata('success'); ?>
							</div>
						<?php endif; ?>
						<?php if ($this->session->flashdata('error')) : ?>
								<div class="alert alert-danger alert-dismissible" role="alert">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<?php echo $this->session->flashdata('error'); ?>
								</div>
							<?php endif; ?>
						<?php
						echo form_open_multipart('Pemesanan/update');
						?>

						<div class="col-sm-12">
							<a style="float: right;" href="<?= base_url('Pemesanan') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="no_rm">No.RM</label>
								<input type="hidden" name="id" value="<?php echo $tb_pemesanan->id_pemesanan ?>">
								<input type="hidden" name="id_diagnosa" value="<?php echo $id; ?>">
								<input type="text" name="no_rm" value="<?php echo $tb_pemesanan->no_rm ?>" class="form-control <?php echo form_error('no_rm') ? 'is-invalid' : '' ?>" placeholder="No.RM" readonly>
								<div class="invalid-feedback">
									<?php echo form_error('no_rm') ?>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="nama_pegawai">Nama Pasien</label>
								<input type="text" name="nama_pasien" class="form-control <?php echo form_error('nama_pegawai') ? 'is-invalid' : '' ?>" value="<?php echo $tb_pemesanan->nama_pasien ?>" placeholder="Nama Pegawai" readonly>
								<div class="invalid-feedback">
									<?php echo form_error('nama_pegawai') ?>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="no_antrian">Nomor Antrian</label>
								<input type="text" name="no_antrian" value="<?php echo $tb_pemesanan->no_antrian ?>" class="form-control <?php echo form_error('no_antrian') ? 'is-invalid' : '' ?>" placeholder="Nomor Antrian" readonly>
								<div class="invalid-feedback">
									<?php echo form_error('no_antrian') ?>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="kode_icdx">Kode Penyakit</label>
								<input type="text" id="kd_icdx" value="<?php echo set_value('kd_icdx') ?>" name="kd_icdx" class="form-control <?php echo form_error('kd_icdx') ? 'is-invalid' : '' ?>" placeholder="Kode Penyakit" autocomplete="off" autofocus required>
								<div class="invalid-feedback">
									<?php echo form_error('kd_icdx') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_penyakit">Nama Penyakit</label>
								<input type="text" name="nama_icdx" placeholder="Nama Penyakit" class="form-control" readonly required>
								<div class="invalid-feedback">
									<?php echo form_error('nama_icdx') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="kode_icdx">Kode Penyakit (2)</label>
								<small class="text-success"> * Hanya Diisi Bila Kode Penyakit Berbeda</small>
								<input type="text" id="kd_icdx2" value="<?php echo set_value('kd_icdx2') ?>" name="kd_icdx2" class="form-control <?php echo form_error('kd_icdx2') ? 'is-invalid' : '' ?>" placeholder="Kode Penyakit" autofocus autocomplete="off">
								<div class="invalid-feedback">
									<?php echo form_error('kd_icdx2') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_penyakit">Nama Penyakit</label>
								<input type="text" name="nama_icdx2" placeholder="Nama Penyakit" class="form-control" readonly required>
								<div class="invalid-feedback">
									<?php echo form_error('nama_icdx2') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="kode_icdx">Kode Penyakit (3)</label>
								<small class="text-success"> * Hanya Diisi Bila Kode Penyakit Berbeda</small>
								<input type="text" id="kd_icdx3" value="<?php echo set_value('kd_icdx3') ?>" name="kd_icdx3" class="form-control <?php echo form_error('kd_icdx3') ? 'is-invalid' : '' ?>" placeholder="Kode Penyakit" autofocus autocomplete="off">
								<div class="invalid-feedback">
									<?php echo form_error('kd_icdx3') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_penyakit">Nama Penyakit</label>
								<input type="text" name="nama_icdx3" placeholder="Nama Penyakit" class="form-control" readonly required>
								<div class="invalid-feedback">
									<?php echo form_error('nama_icdx3') ?>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="status_penyakit">Kasus Penyakit</label>
								<select class="form-control" name="status_penyakit" required>
									<option value="" selected disabled>Silahkan Pilih</option>
									<option <?php if ($tb_pemesanan->status_penyakit == 'Baru') {
													echo "selected";
												} ?>>Baru</option>
									<option <?php if ($tb_pemesanan->status_penyakit == 'Lama') {
													echo "selected";
												} ?>>Lama</option>
									<option <?php if ($tb_pemesanan->status_penyakit == 'KKL') {
													echo "selected";
												} ?>>KKL</option>
								</select>
							</div>
							<div class="form-group">
								<label for="pelayanan_kesehata">Pelayanan Kesehatan</label>
								<select class="form-control" name="pelayanan_kesehatan" required>
									<option value="" selected disabled>Silahkan Pilih</option>
									<option <?php if ($tb_pemesanan->pelayanan_kesehatan == 'Umum') {
													echo "selected";
												} ?>>Umum</option>
									<option <?php if ($tb_pemesanan->pelayanan_kesehatan == 'BPJS') {
													echo "selected";
												} ?>>BPJS</option>
								</select>
							</div>
							<div class="form-group">
								<label for="keadaan_keluar">Keadaan Keluar</label>
								<select class="form-control" name="keadaan_keluar" required>
									<option value="" selected disabled>Silahkan Pilih</option>
									<option <?php if ($tb_pemesanan->keadaan_keluar == 'Pulang') {
													echo "selected";
												} ?>>Pulang</option>
									<option <?php if ($tb_pemesanan->keadaan_keluar == 'Rawat Inap') {
													echo "selected";
												} ?>>Rawat Inap</option>
									<option <?php if ($tb_pemesanan->keadaan_keluar == 'Rujuk') {
													echo "selected";
												} ?>>Rujuk</option>
								</select>
							</div>
							<div class="form-group">
								<label for="prognosa">Prognosa</label>
								<select class="form-control" name="prognosa" required>
									<option value="" selected disabled>Silahkan Pilih</option>
									<option <?php if ($tb_pemesanan->prognosa == 'Sembuh') {
													echo "selected";
												} ?>>Sembuh</option>
									<option <?php if ($tb_pemesanan->prognosa == 'Baik') {
													echo "selected";
												} ?>>Baik</option>
									<option <?php if ($tb_pemesanan->prognosa == 'Buruk') {
													echo "selected";
												} ?>>Buruk</option>			
									<option <?php if ($tb_pemesanan->prognosa == 'Tidak Tentu/Cenderung Sembuh') {
													echo "selected";
												} ?>>Tidak Tentu/Cenderung Sembuh</option>
									<option <?php if ($tb_pemesanan->prognosa == 'Tidak Tentu, Cenderung Tidak Baik') {
													echo "selected";
												} ?>>Tidak Tentu, Cenderung Tidak Baik</option>
								</select>
							</div>
								<div class="form-group">
								<label for="status_pasien">Status Pasien</label>
								<select class="form-control" name="status_pasien" required>
									<option value="" selected disabled>Silahkan Pilih</option>
									<option <?php if ($tb_pemesanan->status_pasien == 'Baru') {
													echo "selected";
												} ?>>Baru</option>
									<option <?php if ($tb_pemesanan->status_pasien == 'Lama') {
													echo "selected";
												} ?>>Lama</option>
								</select>
							</div>
							<div class="form-group">
								<label for="prognosa">Jenis Pelayanan</label>
								<select class="form-control" name="jenis_pelayanan" required>
									<option value="" selected disabled>Silahkan Pilih</option>
									<option <?php if ($tb_pemesanan->jenis_pelayanan == 'Poli Umum') {
													echo "selected";
												} ?>>Poli Umum</option>
									<option <?php if ($tb_pemesanan->jenis_pelayanan == 'Poli Gigi') {
													echo "selected";
												} ?>>Poli Gigi</option>
									<option <?php if ($tb_pemesanan->jenis_pelayanan == 'Poli KIA') {
													echo "selected";
												} ?>>Poli KIA</option>
									<option <?php if ($tb_pemesanan->jenis_pelayanan == 'UGD') {
													echo "selected";
												} ?>>UGD</option>
									<option <?php if ($tb_pemesanan->jenis_pelayanan == 'Laboraturium') {
													echo "selected";
												} ?>>Laboraturium</option>
									<option <?php if ($tb_pemesanan->jenis_pelayanan == 'Baby Spa') {
													echo "selected";
												} ?>>Baby Spa</option>
								</select>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="pengobatan">Pengobatan</label>
								<textarea name="pengobatan" class="form-control <?php echo form_error('pengobatan') ? 'is-invalid' : '' ?>" placeholder="pengobatan"><?= $tb_pemesanan->pengobatan ?></textarea>
								<div class="invalid-feedback">
									<?php echo form_error('pengobatan') ?>
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="tindakan">Tindakan</label>
								<textarea name="tindakan" class="form-control <?php echo form_error('tindakan') ? 'is-invalid' : '' ?>" placeholder="Tindakan"><?= $tb_pemesanan->tindakan ?></textarea>
								<div class="invalid-feedback">
									<?php echo form_error('tindakan') ?>
								</div>
							</div>
						</div>
						<div class="col-md-10">
							<label>Status Pemesanan</label><br>
							<input type="radio" name="status_pemesanan" value="Belum Dilayani" <?php echo ($tb_pemesanan->status_pemesanan == 'Belum Dilayani' ? ' checked' : ''); ?>> Belum Dilayani
							<input style="margin-left: 80px" type="radio" name="status_pemesanan" value="Komentar" <?php echo ($tb_pemesanan->status_pemesanan == 'Komentar' ? ' checked' : ''); ?>> Sudah Dilayani
							<br>
							<input style="float: right;" type="submit" class="btn btn-primary" value="Simpan">
						</div>
						<script type="text/javascript" src="<?php echo base_url() ?>vendors/jquery/dist/jquery.js"></script>
						<?php
						echo form_close();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>