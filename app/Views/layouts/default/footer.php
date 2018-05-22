
</div>
<script src="<?php echo $this->base_url('/js/jquery.js') ?>"></script>
<script src="<?php echo $this->base_url('/js/bootstrap.min.js') ?>"></script>

  <?php 
    /**
     * @type: array
     * Please add the path url
    */
    if(!empty($scripts) && is_array($scripts)){
      foreach($scripts as $script) {
        echo '<script src="' . $script . '"></script>';
      }
    }
  ?>
</body>
</html>