<div class="right_col" role="main">
    <div class="">


        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_title">
                    <p><a href="<?= base_url('pegawai/add'); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Pegawai</a></p>

                    <div class="clearfix"></div>
                </div>
                <?php if ($this->session->flashdata('success')) : ?>
                  <div class="alert alert-success alert-dismissible" role="alert">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $this->session->flashdata('success'); ?>
                  </div>
                <?php endif; ?>
                <div class="x_content">
                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="column-title">No </th>
                                <th class="column-title">NIK </th>
                                <th class="column-title">Nama Pegawai </th>
                                <th class="column-title">Username </th>
                                <th class="column-title">alamat </th>
                                <th class="column-title">No HP </th>
                                <th class="column-title">Foto </th>
                                 <th class="column-title">Status </th>
                                <th class="column-title">Terakhir Login </th>
                                <th class="column-title">Terakhir Update </th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($tb_pegawai as $row) :
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row->NIK; ?></td>
                                    <td><?php echo $row->nama_pegawai; ?></td>
                                    <td><?php echo $row->username; ?></td>
                                    <td><?php echo $row->alamat; ?></td>
                                    <td><?php echo $row->no_hp; ?></td>
                                    <td>
                                        <img src="<?php echo base_url('build/foto/' . $row->foto) ?>" width="64" />
                                    </td>
                                    <td><?php echo $row->nama_status; ?></td>
                                    <td><?= $row->last_login; ?></td>
                                    <td><?= $row->last_update; ?></td>
                                    <td>
                                        <?php if ($user['nama_pegawai'] == $row->nama_pegawai && $user['id_status'] == '2') : ?>
                                        <a href="<?= base_url('pegawai/edit_pegawai/' . $row->id_pegawai) ?>" class="btn btn-primary btn-sm" title="Edit" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo base_url('pegawai/delete/' . $row->id_pegawai) ?>" class="btn btn-danger btn-sm" title="Hapus" onClick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i></a>
                                        <?php elseif ($row->id_status == '1' && $user['nama_pegawai'] == $row->nama_pegawai || $row->id_status == '2') : ?>
                                        <a href="<?= base_url('pegawai/edit_pegawai/' . $row->id_pegawai) ?>" class="btn btn-primary btn-sm" title="Edit" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo base_url('pegawai/delete/' . $row->id_pegawai) ?>" class="btn btn-danger btn-sm" title="Hapus" onClick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"></i></a>
                                    <?php endif;?>
                                    </td>
                                </tr>
                            <?php $no++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>