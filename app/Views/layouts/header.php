<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo empty($title) ? 'Application' : $title ?></title>

    <?php 
    /**
     * @type: array
     * Please add the path url
    */
    if(!empty($styles) && is_array($styles)){
      foreach($styles as $style) {
        echo '<link rel="stylesheet" href="' . $style . '">';
      }
    }
  ?>
    
  </head>
<body>