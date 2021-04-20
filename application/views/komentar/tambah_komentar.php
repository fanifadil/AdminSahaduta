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
                        </div>
                        <div class="x_content">
                            <br />
                            <?php
                            echo validation_errors('<div class="alert alert-warning">', '</div>');
                            //error
                            if (isset($error)) {
                                echo '<div class="alert alert-warning">';
                                echo $error;
                                echo '</div>';
                            }
                            ?>
                            <?= $this->session->flashdata('message'); ?>
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" href="<?= base_url("Komentar/add"); ?>" method="post">
                                <div class="form-group">
                                    <label for="no_rm" class="control-label col-md-3 col-sm-3 col-xs-12">No RM</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control" name="no_rm" id="no_rm" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama" class="control-label col-md-3 col-sm-3 col-xs-12">Nama Pasien</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control" name="nama" id="nama" type="text" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kritik" class="control-label col-md-3 col-sm-3 col-xs-12">Kritik</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control" name="kritik" id="kritik" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="saran" class="control-label col-md-3 col-sm-3 col-xs-12">Saran</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control" name="saran" id="saran" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="penilaian" class="control-label col-md-3 col-sm-3 col-xs-12">Penilaian</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="rating-input" type="text" name="penilaian">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success" class="btn btn-info pull-left">Simpan Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>