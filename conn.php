<?php
$host = "localhost";
$user = "u8712480_hpazk";
$pass = "Vmondev123@";
$dbname = "u8712480_tusbung"; //nama database
$conn = mysqli_connect($host, $user, $pass, $dbname); //pastikan urutan nya seperti ini, jangan tertukar

if (!$conn) { //jika tidak terkoneksi maka akan tampil error
  die(mysqli_connect_error());
} else {
  $query = mysqli_query($conn, 'SELECT * FROM m_pemutusan_wo');
  while ($row = mysqli_fetch_assoc($query)) {
    $result[] = $row;
  }

  if (!$result) {
    die(mysqli_errno($conn));
  }

  echo $result;
}
  
/*CREATE TABLE `produk` ( `id` INT(11) NOT NULL AUTO_INCREMENT ,  `nama_produk` VARCHAR(255) NULL ,  `deskripsi` TEXT NULL ,  `harga_beli` INT(11) NULL ,  `harga_jual` INT(11) NULL ,  `gambar_produk` VARCHAR(255) NULL ,    PRIMARY KEY  (`id`)) ENGINE = InnoDB;*/
