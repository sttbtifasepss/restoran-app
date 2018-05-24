<div class="row">
  <div class="col-sm-8">

    <div id="slimScroll">
      <div class="row">
        <?php foreach($menus as $menu): ?>
          <div class="col-sm-6">
            <div class="thumbnail">
              <a data-fancybox="gallery" href="<?php echo $this->base_url($menu['url_gambar']) ?>">
                <img src="<?php echo $this->base_url($menu['url_gambar']) ?>">
              </a>
              <div class="caption">
                <h4><strong class="text-danger">Rp <?php echo number_format($menu['harga'], 2, ',','.') ?></strong></h4>
                <p><strong><?php echo $menu['nama_menu'] ?></strong></p>
                
                <p><?php echo html_entity_decode($menu['keterangan']) ?></p>
                <p>
                  <button class="btn btn-danger btn-lg btn-block">PESAN</button>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

  </div>
  <div class="col-sm-4">
    ...
  </div>
</div>


<script>
  $(function() {
    $('#slimScroll').slimScroll({
      height: '500px'
    });
  });
</script>