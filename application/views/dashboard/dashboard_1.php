<div class="right_col" role="main">

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="pricing">
            <table id="mytable6" class="table title">
              <thead>
                <tr>
                  <th style="margin-left: 20px">Top 10 Penyakit</th>
                </tr>
              </thead>
              <tbody class="show_penyakit">
              </tbody>
            </table>
          </div>
      </div>
      
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="pricing">
          <table id="mytable6" class="table title">
            <thead>
              <tr>
                <th style="margin-left: 20px">Jumlah Penanganan Tahun Ini</th>
              </tr>
            </thead>
            <tbody>
              <td>
                <h1><?= $penanganantahunan['0']['total'] ?> Pasien (<?= $penanganantahunan['0']['totalL'] ?> L | <?= $penanganantahunan['0']['totalP'] ?> P)</h1>
              </td>
            </tbody>
            <thead>
              <tr>
                <th style="margin-left: 20px">Jumlah Penanganan Bulan Ini</th>
              </tr>
            </thead>
            <tbody>
              <td>
                <h1><?= $penangananbulanan['0']['total'] ?> Pasien (<?= $penangananbulanan['0']['totalL'] ?> L | <?= $penangananbulanan['0']['totalP'] ?> P)</h1>
              </td>
            </tbody>
            <thead>
              <tr>
                <th style="margin-left: 20px">Jumlah Penanganan Minggu Ini</th>
              </tr>
            </thead>
            <tbody>
              <td>
                <h1><?= $penangananmingguan['0']['total'] ?> Pasien (<?= $penangananmingguan['0']['totalL'] ?> L | <?= $penangananmingguan['0']['totalP'] ?> P)</h1>
              </td>
            </tbody>
          </table>
        </div>
      </div>
      
     
      

    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        
     <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel tile fixed_height_520">
          <div class="x_title">
            <h3>Rekapitulasi Kepuasan Penanganan Klinik Sahaduta <small>Berdasarkan Rating Pasien</small></h3>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php foreach ($data2 as $data2) :
              $rating[] = $data2->rating;
              $total[] = (float) $data2->total;
            endforeach; ?>
            <canvas id="canvas2" width="860" height="520"></canvas>
          </div>
        </div>
      </div>    
                
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel tile fixed_height_520">
          <div class="x_title">
            <h3>Jumlah Kunjungan Per Bulan Klinik Sahaduta <small>Berdasarkan Jenis Kelamin Pasien</small></h3>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php foreach ($data as $data) :
              $jk[] = $data->jk;
              $jumlah_jk[] = (float) $data->jumlah_jk;
            endforeach; ?>
            <canvas id="canvas" width="860" height="520"></canvas>
          </div>
        </div>
      </div>
      
      
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel tile fixed_height_520">
        <div class="x_title">
          <h3>Grafik Jumlah Penanganan Pasien Klinik Sahaduta <small>Dalam Setiap Bulan</small></h3>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>


          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">


          <?php foreach ($data3 as $row) :
            $data3['grafik'][] = (float) $row['Januari'];
            $data3['grafik'][] = (float) $row['Februari'];
            $data3['grafik'][] = (float) $row['Maret'];
            $data3['grafik'][] = (float) $row['April'];
            $data3['grafik'][] = (float) $row['Mei'];
            $data3['grafik'][] = (float) $row['Juni'];
            $data3['grafik'][] = (float) $row['Juli'];
            $data3['grafik'][] = (float) $row['Agustus'];
            $data3['grafik'][] = (float) $row['September'];
            $data3['grafik'][] = (float) $row['Oktober'];
            $data3['grafik'][] = (float) $row['November'];
            $data3['grafik'][] = (float) $row['Desember'];
            
          endforeach; ?>
          <canvas id="canvas3" width="860" height="520"></canvas>


        </div>
      </div>
    </div>


    <!--Load chart js-->

  </div>
</div>


</div>
<!-- end of weather widget -->
</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url() . 'assets/admin/Chart.js' ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
  $(document).ready(function() {
    // CALL FUNCTION SHOW PRODUCT
    kunjungan();
    toppenyakit();

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('a1e095bed9535a20e287', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      if (data.message === 'halo') {
        kunjungan();

      }
    });

    // FUNCTION SHOW PRODUCT
    function kunjungan() {
      $.ajax({
        url: '<?php echo site_url('Dashboard/kunjungan'); ?>',
        type: 'GET',
        async: true,
        dataType: 'json',
        success: function(data) {  
          var html = '';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<tr>' +
              '<td>' + data[i].total + '</td>' +
              '</tr>';
          }
          $('.show_kunjungan').html(html);
        }

      });
    }

    function toppenyakit() {
      $.ajax({
        url: '<?php echo site_url('Dashboard/top_penyakit'); ?>',
        type: 'GET',
        async: true,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var i;
          for (i = 0; i < data.length; i++) {
            html += '<tr>' +
              '<td>' + data[i].penyakit + '</td>' +
              '<td>' + data[i].total + '</td>' +
              '</tr>';
          }
          $('.show_penyakit').html(html);
        }

      });
    }
  });
</script>
<!-- <script>
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('a1e095bed9535a20e287', {
    cluster: 'ap1',
    forceTLS: true
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    alert(JSON.stringify(data));
  });
</script> -->
<script>
  var ctx = document.getElementById('canvas');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Laki-Laki', 'Perempuan'],
      datasets: [{
        label: '# of Votes',
        data: <?php echo json_encode($jumlah_jk); ?>,
        backgroundColor: [
          'rgba(52, 172, 224,1 )',
          'rgba(255, 250, 101,1)'
        ],
        borderColor: [
          'rgba(52, 172, 224,1 )',
          'rgba(255, 177, 66, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {}
  });
</script>

<script>
  var ctx = document.getElementById('canvas2');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Sangat Buruk', 'Buruk', 'Cukup', 'Puas', 'Sangat Puas'],
      datasets: [{
        label: '# of Votes',
        data: <?php echo json_encode($rating); ?>,
        backgroundColor: [
          'rgb(234, 181, 67)',
          'rgb(255, 242, 0)',
          'rgb(214, 162, 232)',
          'rgb(52, 172, 224)',
          'rgb(252, 66, 123)',
          'rgb(51, 217, 178)'
          
          
        ],
        borderColor: [
          'rgb(234, 181, 67)',
          'rgb(255, 242, 0)',
          'rgb(214, 162, 232)',
          'rgb(52, 172, 224)',
          'rgb(252, 66, 123)',
          'rgb(51, 217, 178)'
        ],
        borderWidth: 1
      }]
    },
    options: {}
  });
</script>
<script>
  var ctx = document.getElementById('canvas3');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [ 'Januari','Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [{
        label: 'Pasien',
        data: <?php echo json_encode($data3['grafik']); ?>,
        backgroundColor: [
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1)'
        ],
        borderColor: [
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77,1 )',
          'rgba(152, 201, 77, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {}
  });
</script>

<script>
var ctx = document.getElementById('canvas2');
var myChart = new Chart(ctx, {
 type: 'pie',
 data: {
     labels: ['Sangat Buruk', 'Buruk', 'Cukup', 'Puas', 'Sangat Puas'],
     datasets: [{
         label: '# of Votes',
         data: <?php echo json_encode($total); ?>,
         backgroundColor: [
                  'rgb(234, 181, 67)',
                  'rgb(255, 242, 0)',
                  'rgb(214, 162, 232)',
                  'rgb(52, 172, 224)',
                  'rgb(252, 66, 123)',
                  'rgb(51, 217, 178)'
            ],
            borderColor: [
                  'rgb(234, 181, 67)',
                  'rgb(255, 242, 0)',
                  'rgb(214, 162, 232)',
                  'rgb(52, 172, 224)',
                  'rgb(252, 66, 123)',
                  'rgb(51, 217, 178)'
            ],
         borderWidth: 1
     }]
 },
 options: {}
});
</script>