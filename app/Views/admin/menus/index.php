<?php if(!empty($this->sessionFlash('success'))): ?>
    <div class="alert alert-success">
      <ul>
        <?php foreach($this->sessionFlash('success') as $error): ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
<a href="<?php echo $this->base_url('/admin/tambah_menus') ?>" class="btn btn-primary pull-right" style="position:absolute;right:25px;top:20px;">TAMBAH MENU BARU</a>

<div class="panel panel-white">
  <div class="panel-body">
    <table class="table table-striped datatable">
      <thead>
        <tr>
          <th width="10%">#</th>
          <th width="55%">Nama Menu</th>
          <th width="15%" class="text-right">Harga</th>
          <th width="20%"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($menus as $menu): ?>
          <tr class="menu-row-<?php echo $menu['id'] ?>">
            <td class="text-center">
              <a data-fancybox="gallery" href="<?php echo $this->base_url($menu['url_gambar']) ?>">
                <img src="<?php echo $this->base_url($menu['url_gambar']) ?>" class="img img-thumbnail" width="100">
              </a>
            </td>
            <td>
              <strong><?php echo $menu['nama_menu'] ?></strong>
              <p>
                <small><?php echo substr($menu['keterangan'], 0, 100); ?>...</small>
              </p>
            </td>
            <td class="text-right">
              <span class="pull-left">Rp</span> <?php echo number_format($menu['harga'], 2,',','.') ?>
            </td>
            <td class="text-right">
              <a href="<?php echo $this->base_url('/admin/edit_menus/' . $menu['id']) ?>" class="btn btn-default btn-sm">Edit</a>
              <button type="buton" class="btn btn-delete btn-danger btn-sm" data-id="<?php echo $menu['id'] ?>" data-nama="<?php echo $menu['nama_menu'] ?>">Hapus</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php $this->remove_flash(); ?>

<script>
  $(function() {
    $('.datatable').DataTable();


    $('.btn-delete').click(function() {
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      swal('Anda yakin ingin menghapus menu ' + nama, {
        buttons: true
      }).then(function(event) {
        if(event){
          var _id = id;
          $.getJSON('<?php echo $this->base_url('/admin/destroy/') ?>/' + id, function(json) {
            if(json.result) {
              $('.menu-row-' + _id).remove();
            }
            swal(json.message);
          });
        }
      });
    });
  });

  
</script>