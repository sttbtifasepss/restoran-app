<div>
<div class="panel panel-white">
    <table class="table datatable">
      <thead>
        <tr>
          <th>No</th>
          <th>Menu</th>
          <th>Tanggal</th>
          <th>Invoice</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $no = 1;
          foreach($items as $item): ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $item['nama_menu']; ?></td>
            <td><?php echo date('d/m/y h:i A', strtotime($item['tgl_order'])); ?></td>
            <td>#<?php echo $item['no_order']; ?></td>
            <td class="text-right"><span class="pull-left">Rp</span> <?php echo number_format($item['harga'],2,',','.'); ?></td>
          </tr>
        <?php 
        $no++;
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  $(function() {
    $('.datatable').DataTable();
  });
</script>