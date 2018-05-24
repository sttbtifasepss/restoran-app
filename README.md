# Restoran

Sebuah project kecil untuk memenuhi tugas kuliah dengan menggunakan konsep MVC

# Configurasi & Installasi
1. Download atau clone repositori ini, lalu masukan ke webserver anda. Misalkan menggunakan "xampp" simpan pada folder xampp/htdocs/restoran-app
2. Siapkan 1 nama database misal (restoran_db) dengan MySql yang bisa di akses di http://localhost/phpmyadmin
3. Import database "restoran.sql" ke database yang sudah disiapkan
4. Buka file /Core/Config.php
```
    ...

    public $driver    = 'mysql';
    public $host      = 'localhost';
    public $database  = 'nama_database_yang_sudah_disiapkan'; // lihat poit 2
    public $user      = 'database_user';
    public $password  = 'database_password';

    public $baseUrl   = 'http://localhost/restoran-app/public';
    
    ...
```
5. Jalankan applikasi dengan mengakses http://localhost/restoran-app/public
6. Akses untuk Login http://localhost/restoran-app/public/auth/login
7. Akun untuk login
```
  [ADMIN]
    NIP       : admin
    PASSWORD  : 123456
  [KOKI]
    NIP       : koki
    PASSWORD  : 123456
  [PELAYAN]
    NIP       : pelayan
    PASSWORD  : 123456
  [KASIR]
    NIP       : kasir
    PASSWORD  : 123456
```
