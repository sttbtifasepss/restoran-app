  
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