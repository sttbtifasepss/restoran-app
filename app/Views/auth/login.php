<div class="card" style="margin:10px auto; width:350px;">
  <div class="card-body">
    <form action="<?php echo $this->base_url('/auth/store_auth') ?>" method="post">
      <div class="text-center">
        <h3>Login Page</h3>
      </div>
      <?php if(!empty($this->sessionFlash('errors'))): ?>
        <div class="alert alert-warning">
          <ul>
            <?php foreach($this->sessionFlash('errors') as $error): ?>
              <li><?php echo $error; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <hr>
      <table width="100%">
        <tr>
          <td>NIP</td>
          <td>
            <input type="text" name="nip" id="" class="form-input" required>
          </td>
        </tr>
        <tr>
          <td>Password</td>
          <td>
            <input type="password" name="password" id="" class="form-input" required>
          </td>
        </tr>
      </table>
      <br>
      <div class="text-right">
        <button class="button">LOGIN</button>
      </div>
    </form>
  </div>  
</div>
<?php $this->remove_flash(); ?>