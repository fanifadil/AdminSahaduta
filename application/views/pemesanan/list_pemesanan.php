<div class="right_col" role="main">
  <div class="">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <div class="clearfix"></div>
        </div>
        <?php if ($this->session->flashdata('success')) : ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php endif; ?>

        <?php
        echo validation_errors('<div class="alert alert-warning">', '</div>');
        //error
        if (($this->session->flashdata('error'))) {
          echo '<div class="alert alert-warning">';
          echo $this->session->flashdata('error');
          echo '</div>';
        }
        ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="pricing">
            <div class="title">
              <h2>Jumlah Antrian</h2>
              <h1><?php echo $antri ?></h1>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="pricing">
            <div class="title">
              <h2>Yang Terpanggil</h2>
              <h1><?= $dilayani ?></h1>
            </div>
          </div>
        </div>
        <div class="x_content">
          <div class="pricing_footer">
            <button class="btn btn-primary" title="Ambil Antrian" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus"></i>
              Ambil Antrian
            </button>
          </div>
        </div>
        <div class="x_content">
          <table id="datatable-fixed-header" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nomor Antrian</th>
                <th>Nomor RM</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Waktu Pemesanan</th>
                <th>Jenis Pemesan</th>
                <th>Status Pemesanan</th>
                <th width="200">Action</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $no = 1;
              foreach ($tb_pemesanan as $row) :
              ?>
                <tr>
                  <th scope="row"><?php echo $row->no_antrian; ?></th>
                  <td><?php echo $row->no_rm; ?></td>
                  <td><?php echo $row->nama_pasien; ?></td>
                  <td><?php echo $row->jenis_kelamin; ?></td>
                  <td><?php echo $row->waktu_pemesanan; ?></td>
                <?php if ($row->pemesan == "Online") : ?>
                  <td><h4><span class="label label-warning">Online</span></h4></td>
                  <?php else : ?>
                  <td><h4><span class="label label-info">Offline</span></h4></td>
                <?php endif ;?>
                <?php if ($row->status_pemesanan == "Komentar") : ?>
                    <td><span class="label label-success">Sudah Dilayani</span></td>
                  <?php elseif ($row->status_pemesanan == "Sudah Dilayani") : ?>
                    <td><span class="label label-success">Sudah Dilayani</span></td>
                  <?php else : ?>
                    <td><span class="label label-danger">Belum Dilayani</span></td>
                <?php endif; ?>
                  <td>
                    <a href="<?php echo base_url('pemesanan/delete/' . $row->id_pemesanan) ?>" class="btn btn-danger btn-sm" title="Hapus" onClick="return confirm('Apakah anda yakin ingin menghapus data ini?');"><i class="fa fa-trash"> Hapus</i></a>
                    <?php if ($row->status_pemesanan == "Belum Dilayani") : ?>
                      <a href="<?php echo base_url('pemesanan/detail_pemesanan/' . $row->id_pemesanan) ?>" class="btn btn-primary btn-sm" title="detail"><i class="fa fa-edit"> Detail</i></a>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php $no++;
              endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Tambah Antrian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        echo validation_errors('<div class="alert alert-warning">', '</div>');
        //error
        if (($this->session->flashdata('error'))) {
          echo '<div class="alert alert-warning">';
          echo $this->session->flashdata('error');
          echo '</div>';
        }
        echo form_open_multipart(base_url('Pemesanan'));
        ?>

        <div class="col-md-12">
          <div class="form-group text-left">
            <label>No. RM</label>
            <input type="text" id="no_rm" name="no_rm" class="form-control" value="<?php echo set_value('no_rm') ?>" placeholder="Nomor RM" autocomplete="off" autofocus>
          </div>
          <div class="form-group text-left">
            <label>Nama Pasien</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama Pasien" readonly>
          </div>
          <div class="form-group text-left">
            <label>No Antrian</label>
            <input type="text" name="no_antrian" class="form-control" value="<?php echo set_value('no_antrian', $no_antrian) ?>" placeholder="Nomor Antrian" readonly>
          </div>
          <input type="hidden" name="id_pegawai" class="form-control" value="<?php echo $user["id_pegawai"]; ?>" placeholder="Id Pegawai" readonly>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
  <div><a href="javascript:window.location.reload()"></a><b class="hidden" id="countdown"></bc></b></div>
</div>

<script type="text/javascript" src="<?php echo base_url() ?>vendors/jquery/dist/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- autorefresh halaman -->
<script>
  function refreshpage(interval, countdownel, totalel) {
    var countdownel = document.getElementById(countdownel)
    var totalel = document.getElementById(totalel)
    var timeleft = interval + 1
    var countdowntimer

    function countdown() {
      timeleft--
      countdownel.innerHTML = timeleft
      if (timeleft == 0) {
        clearTimeout(countdowntimer)
        window.location.reload()
      }
      countdowntimer = setTimeout(function() {
        countdown()
      }, 1000)
    }

    countdown()
  }

  window.onload = function() {
    refreshpage(60, "countdown") // refreshpage(duration_in_seconds, id_of_element_to_show_result)
  }
</script>

<!-- Chat online -->
<!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5dc90dc943be710e1d1cae13/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> -->
<!--End of Tawk.to Script-->

<script>
  $(document).ready(function() {
    // CALL FUNCTION SHOW PRODUCT
    tampilantrian();

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('a1e095bed9535a20e287', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      if (data.message === 'halo') {
        tampilantrian();

      }
    });

    // FUNCTION SHOW PRODUCT
    function tampilantrian() {
      $.ajax({
        url: '<?php echo site_url('Pemesanan/ambilData'); ?>',
        type: 'GET',
        async: true,
        dataType: 'json',
        success: function(data) {
          var html = '';
          // var count = 1;
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<tr class="odd gradeX">' +
              '<th class="row">' + data[i].no_antrian + '</th>' +
              '<td>' + data[i].no_rm + '</td>' +
              '<td>' + data[i].nama_pasien + '</td>' +
              '<td>' + data[i].jenis_kelamin + '</td>' +
              '<td>' + data[i].waktu_pemesanan + '</td>' +
              '<td>' +
              '<a href="javascript:void(0);" class="btn btn-sm btn-info item_edit" data-id="' + data[i].product_id + '" data-name="' + data[i].product_name + '" data-price="' + data[i].product_price + '">Edit</a>' +
              '<a href="javascript:void(0);" class="btn btn-sm btn-danger item_delete" data-id="' + data[i].product_id + '">Delete</a>' +
              '</td>' +
              '</tr>';
          }
          $('.tampilantrian').html(html);
        }

      });
    }

  });
</script>

<?php echo form_close(); ?>