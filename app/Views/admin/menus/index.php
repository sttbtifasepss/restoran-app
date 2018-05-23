<?php if(!empty($this->sessionFlash('success'))): ?>
    <div class="alert alert-success">
      <ul>
        <?php foreach($this->sessionFlash('success') as $error): ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

<div class="panel panel-white">
  <div class="panel-body">
    <table class="table datatable">
      <thead>
        <tr>
          <th width="10%">#</th>
          <th width="70%">Nama Menu</th>
          <th width="10%" class="text-right">Harga</th>
          <th width="10%"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($menus as $menu): ?>
          <tr>
            <td class="text-center">
              <img src="<?php echo $this->base_url($menu['url_gambar']) ?>" class="img img-thumbnail" width="100">
            </td>
            <td>
              <strong><?php echo $menu['nama_menu'] ?></strong>
              <p>
                <small><?php echo substr($menu['keterangan'], 0, 150); ?>...</small>
              </p>
            </td>
            <td class="text-right">
              <span class="pull-left">Rp</span> <?php echo $menu['harga'] ?>
            </td>
            <td><?php echo $menu['id'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php $this->remove_flash(); ?>