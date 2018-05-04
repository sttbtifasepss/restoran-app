# Restoran

Sebuah project kecil untuk memenuhi tugas kuliah dengan menggunakan konsep MVC

# Configurasi
Buka file /Core/Config.php
```
    ...

    public $driver    = 'mysql';
    public $host      = 'localhost';
    public $database  = 'nama_database_anda';
    public $user      = 'database_user';
    public $password  = 'database_password';

    public $baseUrl   = 'http://localhost/restoran-app/public';
    
    ...
```
# Contoh
create data lihat contoh dibawah ini
```
  /**
  * Dalam Controller
  */
  ...

  public function index () {
    $user = $this->model('user');
    $user->create([
      'nama' => 'Nama User',
      'umur' => '19'
    ]);
  }

  ... 

  /**
  * Dalam Model User
  */

  class user extends Database {

      protected $table = 'user';

      public function __construct() {
        parent::__construct();
      }

      public function create($data) {
        $this->insert($this->table, $data);
      }
  }


```

Menggunakan view templating
```

  /**
  * Dalam controller homeController
  */

  public function index () {

    // Tambahkan layout header
    $this->view('layouts/header', [
      // Buat judul halaman
      'title' => 'Home Page'
    ]);
    $this->view('home');

    // Tambahkan layout penutup
    $this->view('layouts/footer');

    /**
    * Jika ingin menambahkan style dan script
    */
    $this->view('layouts/header', [
      'title' => 'Home Page',
      'styles' => [
        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css',
        // dan seterusnya...
      ]
    ]);
    $this->view('home');
    $this->view('layouts/footer', [
      'scripts' => [
        'https://code.jquery.com/jquery-3.3.1.slim.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js',
        // dan seterusnya...
      ]
    ]);

  }

```

### coming soon...