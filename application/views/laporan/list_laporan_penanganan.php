<div class="right_col" role="main">
  <div class="">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
        <?php if ($title != 'Laporan Penanganan Pasien') : ?>
          <h2><?php echo $title ?></h2>
        <?php else : ?>
          <?php if ($this->session->userdata('startDate') && $this->session->userdata('endDate')) : ?>
            <h2>Laporan Penanganan <?= $this->session->userdata('startDate') ?> Sampai <?= $this->session->userdata('endDate') ?></h2>
          <?php else : ?>
            <h2><?php echo $title ?></h2>
          <?php endif; ?>
        <?php endif; ?>
          <div class="clearfix"></div>
        </div>
      <form method="post" action="<?=base_url('Laporan/laporan_penanganan_semua')?>">   
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div style="margin-left: 260px" class="col-md-3">
              <div class="form-group">
                <label for="tanggal_awal">Tanggal Awal</label>
                <input type="text" name="tgl_awal" id="tglAwal" value="<?=set_value('tgl_awal')?>" autocomplete="off">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="tanggal_akhir">Tanggal Akhir</label>
                <input type="text" name="tgl_akhir" id="tglAkhir" value="<?=set_value('tgl_akhir')?>" autocomplete="off">
                <input style="margin-left: 20px" type="submit" name="submit" class="btn-primary" value="Cari">
              </div>
            </div>
            <!--<div style="margin-left: 5">-->
            <!--  <div class="form-group">-->
            <!--    <input type="submit" name="submit" class="btn-primary" value="Cari">-->
            <!--  </div>-->
            <!--</div>-->
          </div>
        </div>
      </form>
        <br>
        <div class="x_content">
          <table id="mytable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>No.RM</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
                <th>Kode ICDX</th>
                <th>Pengobatan</th>
                <th>Tindakan</th>
                <th>Keadaan Keluar</th>
                <th>Prognosa</th>
                <th>Pelayanan Kesehatan</th>
                <th>Jenis Pelayanan</th>
                <th>Tanggal Periksa</th>
                <th>Pegawai</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
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
      dom: 'Bfrtip',
      lengthMenu: [
        [10, 25, 50, -1],
        ['10 rows', '25 rows', '50 rows', 'Show all']
      ],
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength'
      ],
      scrollX: true,
      ajax: {
        "url": "<?php if ($title == 'Laporan Penanganan Pasien') : ?>
        <?php echo base_url() . 'Laporan/penanganan_semua' ?>
      <?php elseif ($title == 'Laporan Penanganan Pasien Hari Ini') : ?>
        <?php echo base_url() . 'Laporan/penanganan_harian' ?>
      <?php elseif ($title == 'Laporan Penanganan Pasien Minggu Ini') : ?>
        <?php echo base_url() . 'Laporan/penanganan_mingguan' ?>
      <?php elseif ($title == 'Laporan Penanganan Pasien Bulan Ini') : ?>
        <?php echo base_url() . 'Laporan/penanganan_bulanan' ?>
      <?php elseif ($title == 'Laporan Penanganan Pasien Tahun Ini') : ?>
        <?php echo base_url() . 'Laporan/penanganan_tahunan' ?>
      <?php endif; ?> ",
      "type": "POST"
      },
      columns: [{
          "data": "no_rm"
        },
        {
          "data": "no_rm"
        },
        {
          "data": "nama_pasien"
        },
        {
          "data": "jenis_kelamin"
        },
        {
          "data": "umur"
        },
        { data:"kd_icdx",
          render: function(data,type,row){
            if(row.kd_icdx2 == null || row.kd_icdx2 == "" && row.kd_icdx3 == null || row.kd_icdx3 == ""){
              return '*'+row.kd_icdx;
            }else if(row.kd_icdx2 == null || row.kd_icdx2 == ""){
              return '*'+row.kd_icdx+'<br>'+
                   '*'+row.kd_icdx3;
            }else if(row.kd_icdx3 == null || row.kd_icdx3 == ""){
              return '*'+row.kd_icdx+'<br>'+
                   '*'+row.kd_icdx2;
            }else{
              return '*'+row.kd_icdx+'<br>'+
                   '*'+row.kd_icdx2+'<br>'+
                   '*'+row.kd_icdx3;
            }
          }
        },
        
        {
          "data": "pengobatan"
        },
        {
          "data": "tindakan"
        },
        {
          "data": "keadaan_keluar"
        },
        {
          "data": "prognosa"
        },
        {
          "data": "pelayanan_kesehatan"
        },
        {
          "data": "jenis_pelayanan"
        },
        {
          "data": "tgl_pemesanan"
        },
        {
          "data": "nama_pegawai"
        }
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