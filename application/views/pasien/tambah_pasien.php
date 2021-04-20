<!--<link href="<?= base_url('assets/custom/sweetalert/sweetalert2.min.css') ?>" rel="stylesheet">-->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2><?=$title ?></h2>
							<div class="clearfix"></div>
						</div>

						<!--<div class="alert_success" id="success" data-success="<?= $this->session->flashdata('success'); ?>"-->
      <!--  				data-failed="<?= $this->session->flashdata('failed'); ?>"></div>-->

				        <div class="col-sm-12">
				        <a style="float: right;" href="<?= base_url('Pasien') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
				        </div>
						<?php
						echo form_open_multipart('Pasien/add');
						?>
					<?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                        <?elseif ($this->session->flashdata('failed')) : ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $this->session->flashdata('failed'); ?>
                        </div>
                    <?php endif; ?>
						<div class="col-md-6">
						    <div class="form-group">
								<label for="no_rm">No RM</label>
								<input type="text" name="no_rm" value="<?= set_value('no_rm')?>" class="form-control <?php echo form_error('no_rm') ? 'is-invalid' : '' ?>" placeholder="No RM" required>
								<small class="text-danger"><?= form_error('no_rm'); ?></small>
							</div>	
						    <div class="form-group">
								<label for="NIK">NIK</label>
								<input type="text" name="NIK" value="<?= set_value('NIK')?>" class="form-control <?php echo form_error('NIK') ? 'is-invalid' : '' ?>" placeholder="NIK">
								<small class="text-danger"><?= form_error('NIK'); ?></small>
							</div>	
							<div class="form-group">
								<label for="nama_pasien">Nama Pasien</label>
								<input type="text" autocomplete="off" name="nama_pasien" value="<?= set_value('nama_pasien')?>" class="form-control <?php echo form_error('nama_pasien') ? 'is-invalid' : '' ?>" placeholder="Nama Pasien">
								<small class="text-danger"><?= form_error('nama_pasien'); ?></small>
							</div>
							<div class="form-group">
								<label for="tgl_lahir">Tanggal Lahir</label>
								<small class="text-success"> * Klik Tanggalnya</small>
								<input type="text" autocomplete="off" name="tgl_lahir" value="<?= set_value('tgl_lahir')?>" class="form-control <?php echo form_error('tgl_lahir') ? 'is-invalid' : '' ?>" placeholder="MM/DD/YYYY" id="lahir">
								<small class="text-danger"><?= form_error('tgl_lahir'); ?></small>
							</div>
							<!--<div class="form-group">-->
							<!--	<label for="umur">Umur</label>-->
							<!--	<input type="text" name="umur" value="<?= set_value('umur')?>" class="form-control <?php echo form_error('umur') ? 'is-invalid' : '' ?>" placeholder="Umur" id="usia" readonly>-->
							<!--	<small class="text-danger"><?= form_error('umur'); ?></small>-->
							<!--</div>-->
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<input type="text" name="alamat" value="<?= set_value('alamat')?>" class="form-control <?php echo form_error('alamat') ? 'is-invalid' : '' ?>" placeholder="Alamat">
								<small class="text-danger"><?= form_error('alamat'); ?></small>
							</div>
							<div class="form-group">
								<label for="desa">Desa</label>
								<input type="text" name="desa" value="<?= set_value('desa')?>" class="form-control <?php echo form_error('desa') ? 'is-invalid' : '' ?>" placeholder="Desa">
								<small class="text-danger"><?= form_error('desa'); ?></small>
							</div>
							<div class="form-group">
								<label for="kota">Kota</label>
								<input type="text" name="kota" value="<?= set_value('kota')?>" class="form-control <?php echo form_error('kota') ? 'is-invalid' : '' ?>" placeholder="Kota">
								<small class="text-danger"><?= form_error('kota'); ?></small>
							</div>
							<div class="form-group">
								<label for="nama_kk">Nama KK</label>
								<input type="text" name="nama_kk" value="<?= set_value('nama_kk')?>" class="form-control <?php echo form_error('nama_kk') ? 'is-invalid' : '' ?>" placeholder="Nama KK">
								<small class="text-danger"><?= form_error('nama_kk'); ?></small>
							</div>
						</div>
						<div class="col-md-6">
						<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
						<script type="text/javascript" src="<?php echo base_url()?>vendors/jquery/dist/jquery.js"></script>
							<div class="form-group">
								<label for="id_agama">Agama</label>
                                <select class="form-control" id="id_agama" name="id_agama">
                                	<option selected disabled>Silahkan Pilih</option>
                                    <?php foreach ($tb_agama as $rows) : ?>
                                        <option value="<?= $rows->id_agama; ?>">
                                        	<?= $rows->agama; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
								<small class="text-danger"><?= form_error('id_agama'); ?></small>
							</div>			
							<div class="form-group">
								<label for="id_pendidikan">Pendidikan</label>
                                <select class="form-control" id="id_pendidikan" name="id_pendidikan">
                                	<option selected disabled>Silahkan Pilih</option>
                                    <?php foreach ($tb_pendidikan as $rows) : ?>
                                        <option value="<?= $rows->id_pendidikan; ?>"><?= $rows->pendidikan; ?></option>
                                    <?php endforeach; ?>
                                </select>
								<small class="text-danger"><?= form_error('id_pendidikan'); ?></small>
							</div>
							<div class="form-group">
								<label for="id_pekerjaan">Pekerjaan</label>
                                <select class="form-control" id="id_pekerjaan" name="id_pekerjaan">
                                	<option selected disabled>Silahkan Pilih</option>
                                    <?php foreach ($tb_pekerjaan as $rows) : ?>
                                        <option value="<?= $rows->id_pekerjaan; ?>"><?= $rows->pekerjaan; ?></option>
                                    <?php endforeach; ?>
                                </select>
								<small class="text-danger"><?= form_error('id_pekerjaan'); ?></small>
							</div>
							<div class="form-group">
								<label for="id_jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control" id="id_jenis_kelamin" name="id_jenis_kelamin">
                                	<option selected disabled>Silahkan Pilih</option>
                                    <?php foreach ($tb_jenis_kelamin as $rows) : ?>
                                        <option value="<?= $rows->id_jenis_kelamin; ?>"><?= $rows->jenis_kelamin; ?></option>
                                    <?php endforeach; ?>
                                </select>
								<small class="text-danger"><?= form_error('id_jenis_kelamin'); ?></small>
							</div>
							<div class="form-group">
								<label for="darah">Golongan Darah</label>
								<select class="form-control" name="darah">
									<option selected disabled>Silahkan Pilih</option>
									<option>A</option>
									<option>B</option>
									<option>O</option>
									<option>AB</option>
								</select>
								<small class="text-danger"><?= form_error('darah'); ?></small>
							</div>
							<div class="form-group">
								<label for="no_hp">Nomor HP</label>
								<input type="text" name="no_hp" value="<?= set_value('no_hp')?>" class="form-control <?php echo form_error('no_hp') ? 'is-invalid' : '' ?>" placeholder="Nomor HP"
								 id="nomor-hp">
								<small class="text-danger"><?= form_error('no_hp'); ?></small>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary" value="Simpan">
							</div>
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