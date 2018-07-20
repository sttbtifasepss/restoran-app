<div class="row">
  <div class="col-lg-4 col-md-6">
      <div class="panel panel-white stats-widget">
          <div class="panel-body">
              <div class="pull-left">
                  <span class="stats-number">RP <?php echo number_format($income['income'],2,',','.') ?></span>
                  <p class="stats-info">Total Pendapatan</p>
              </div>
              <div class="pull-right">
                  <i class="icon-arrow_upward stats-icon"></i>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-4 col-md-6">
      <div class="panel panel-white stats-widget">
          <div class="panel-body">
              <div class="pull-left">
                  <span class="stats-number"><?php echo $terjual['jumlah'] ?> menu</span>
                  <p class="stats-info">Total Terjual</p>
              </div>
              <div class="pull-right">
                  <i class="icon-arrow_upward stats-icon"></i>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-4 col-md-6">
      <div class="panel panel-white stats-widget">
          <div class="panel-body">
              <div class="pull-left">
                  <span class="stats-number">RP <?php echo number_format($unpaid['total'],2,',','.') ?></span>
                  <p class="stats-info">Total Belum Dibayar</p>
              </div>
              <div class="pull-right">
                  <i class="icon-arrow_upward stats-icon"></i>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="panel panel-white">
  <div class="panel-body text-center">
    <h4>Grafik Tahun <?php echo date('Y') ?></h4>
    <canvas id="myChart" width="400" height="150"></canvas>
  </div>
</div>


<script>
  var labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: labels,
          datasets: [
            {
              label: 'Pendapatan',
              data: <?php echo json_encode($cpendapatan) ?>,
              fill: false,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 2
          },
          {
              label: 'Penjualan',
              data: <?php echo json_encode($cterjual) ?>,
              fill: false,
              backgroundColor: [
                  'rgba(50, 129, 255, 0.2)',
                  'rgba(50, 129, 255, 0.2)',
                  'rgba(50, 129, 255, 0.2)',
                  'rgba(50, 129, 255, 0.2)',
                  'rgba(50, 129, 255, 0.2)',
                  'rgba(50, 129, 255, 0.2)'
              ],
              borderColor: [
                  'rgba(50, 129, 255,1)',
                  'rgba(50, 129, 255, 1)',
                  'rgba(50, 129, 255, 1)',
                  'rgba(50, 129, 255, 1)',
                  'rgba(50, 129, 255, 1)',
                  'rgba(50, 129, 255, 1)'
              ],
              borderWidth: 2
          }
        ]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero:true
                  }
              }]
          }
      }
  });
</script>