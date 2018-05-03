<h2>Halaman Pesanan</h2>
<table border="1">
  <tr><th>ID</th><th>NO ORDER</th><th>PELANGGAN</th><th>TGL ORDER</th><th>TOTAL</th><th>STATUS BAYAR</th><th>STATUS</th></tr>
  <?php
include "koneksi.php";
$data=mysql_query("SELECT * from order where status = 'Baru' order by id desc");
if ($data === FALSE) {
  die(mysql_error());
}
$no=1;
while ($hasil=mysql_fetch_array($data)) {
  echo "<tr>
  <td>$no</td>
  <td>$hasil[id]</td>
  <td>$hasil[no_order]</td>
  <td>$hasil[pelanggan]</td>
  <td>$hasil[tgl_order]</td>
  <td>$hasil[total]</td>
  <td>$hasil[status_bayar]</td>
  <td>$hasil[status]</td>
  <tr></tr>
  </tr>";
  $no++;
}
?>
</table>
