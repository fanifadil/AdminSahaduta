<div class="right_col" role="main">
  <div class="">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <p><a href="<?= base_url('Pasien/add'); ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah Pasien</a></p>
          <div class="clearfix"></div>
        </div>
        <?php if ($this->session->flashdata('success')) : ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php endif; ?>
        <div class="x_content">
          <table id="mytable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="column-title">No </th>
                <th class="column-title">No RM </th>
                <th class="column-title">NIK</th>
                <th class="column-title">Nama</th>
                <th class="column-title">Nama KK</th>
                <th class="column-title">Tanggal Lahir</th>
                <th class="column-title">Umur</th>
                <th class="column-title">Alamat</th>
                <th class="column-title">No HP</th>
                <th class="column-title">Desa</th>
                <th class="column-title">Kota</th>
                <th class="column-title">Darah</th>
                <th class="column-title">Agama</th>
                <th class="column-title">Pendidikan</th>
                <th class="column-title">Pekerjaan</th>
                <th class="column-title">Jenis Kelamin</th>
                <th class="column-title">Edit</th>
                <th class="column-title">Hapus</th>
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
            "url": "<?php echo base_url() . 'Pasien/get_data_json' ?>",
            "type": "POST"
          },
          columns: [
            {
              "data": "no_rm"
            },
            {
              "data": "no_rm"
            },
            {
              "data": "nik"
            },
            {
              "data": "nama_pasien"
            },
            {
              "data": "nama_kk"
            },
            {
              "data": "tgl_lahir"
            },
            {
              "data": "umur"
            },
            {
              "data": "alamat"
            },
            {
              "data": "no_hp"
            },
            {
              "data": "desa"
            },
            {
              "data": "kota"
            },
            {
              "data": "darah"
            },
            {
              "data": "agama"
            },
            {
              "data": "pendidikan"
            },
            {
              "data": "pekerjaan"
            },
            {
              "data": "jenis_kelamin"
            },
            {
              "data": "edit"
            },
            {
              "data": "hapus"
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