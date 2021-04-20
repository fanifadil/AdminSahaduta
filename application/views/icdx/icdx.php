<div class="right_col" role="main">
    <div class="">
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <!-- <a><a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#tambahModal"><i class="fa fa-plus"></i>Tambah <?= $title; ?></a></p> -->
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="mytable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="column-title">No </th>
                                <th class="column-title">Kode ICDX</th>
                                <th class="column-title">Nama Icdx</th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <script src="<?php echo base_url() . 'assets1/js/bootstrap.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets1/js/jquery.datatables.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets1/js/dataTables.bootstrap.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets1/js/jquery-2.1.4.min.js' ?>"></script>
        <script>
            $(document).ready(function() {
                // Setup datatables
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var table = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                            .off('.DT')
                            .on('input.DT', function() {
                                api.search(this.value).draw();
                            });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        "url": "<?php echo base_url() . 'Icdx/get_data_json' ?>",
                        "type": "POST"
                    },
                    columns: [{
                            "data": "kd_icdx"
                        },
                        {
                            "data": "kd_icdx"
                        },
                        {
                            "data": "nama_icdx"
                        },
                    ],
                    order: [
                        [1, 'asc']
                    ],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }

                });
                // end setup datatables	

            });
        </script>