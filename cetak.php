<html>
<body onLoad="window.print();">
    <br>
    <center>
    <table border ="0" cellpadding="0">
      <tr>
        <td> <img src="bungamawar.jpg" width="50%" heigth="50%"></td>
        <td>
          <br><center><big><b>Toko Mawar</b></big>
		<br><center><small><big>Toko mawar, Banjaran, Kec. Banjaran, Kabupaten Bandung, Jawa Barat</big>
          <br>Kode Pos 40377</small> 
        </td>
      </tr>
    </table>
    
    <HR size="2.5" NOSHADE>
    <br><small><b><u><big><b>DAFTAR BARANG</u></b></big>
<br><br>
    </center>
    
  <table width="100%" align="center" cellspacing="0" cellpadding="2" border="1px" >       
        <tr>
          <th width="3%" align="center"bgcolor="#CCCCCC">No</th>
    
      <th width="15%" align="center"bgcolor="#CCCCCC">Nama Barang</th>
    
      <th width="13%" align="center"bgcolor="#CCCCCC">Kategori Barang</th>
          <th width="13%" align="center"bgcolor="#CCCCCC">Jumlah Barang</th>
          <th width="13%" align="center"bgcolor="#CCCCCC">Harga Barang</th>
          <th width="13%" align="center"bgcolor="#CCCCCC">Jumlah Stock Gudang</th>
          <th width="13%" align="center"bgcolor="#CCCCCC">Jumlah Seluruh Stock</th>
        </tr>
<?php
require 'connection.php'; 

$nomor = 1;
$tampil = mysqli_query($conn, "SELECT * FROM tbl_barang m, tbl_gudang s WHERE s.brg_id = m.brg_id");
while ($data = mysqli_fetch_array($tampil)) {
?>
  <tr style="text-align:center">
    <td><?php echo $nomor++; ?>
    <td><?php echo $data['brg_nama']; ?></td>
    <td><?php echo $data['brg_kategori']; ?></td>
    <td><?php echo $data['brg_quantity']; ?></td>
    <td><?php echo $data['brg_harga']; ?></td>
    <td><?php echo $data['gud_quantity']; ?></td>
    <td><?php echo $data['gud_quantity'] + $data['brg_quantity']; ?></td>
  </tr>
<?php } ?>
      </table>
</body>
</html>
