<div style="width:400px; margin:0 auto;">

  <form action="<?php echo $this->base_url('/admin/save_menus') ?>" method="POST" enctype="multipart/form-data">

  <?php if(!empty($this->sessionFlash('errors'))): ?>
    <div class="alert alert-warning">
      <ul>
        <?php foreach($this->sessionFlash('errors') as $error): ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

    <div class="panel panel-white">
      <div class="panel-body">
        
        <div class="form-group">
          <label for="nama">Nama Menu <span class="text-danger">*</span></label>
          <input type="text" name="nama_menu" id="nama" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="harga">Harga Menu <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Rp</span>
            <input type="decimal" name="harga" id="harga" class="form-control text-right" required>
          </div>
        </div>

        <div class="form-group">
          <label for="nama">Keterangan <span class="text-danger">*</span></label>
          <textarea name="keterangan" id="keterangan" class="form-control" required cols="30" rows="7"></textarea>
        </div>

        <div class="form-group">
          <label for="image">Gambar Menu <span class="text-danger">*</span></label>
          <input type="file" name="image" id="image" class="form-control" required>
          <small>* Silakan masukan gambar dengan ukurang 400 x 300 px</small>
        </div>
        <hr />
        <div class="form-group">
          <button class="btn btn-primary">TAMBAHKAN</button>
          <a href="<?php echo $this->base_url('/admin/menus') ?>" class="btn btn-default pull-right">BATAL</a>
        </div>

      </div>
    </div>
  </form>
  
</div>
<?php $this->remove_flash(); ?>