<?php
include 'conn.php';
header('Access-Control-Allow-Origin: *');

$lat   = $_POST['lat'];
$long   = $_POST['long'];
$unitupi   = $_POST['unitupi'];
$idpel   = $_POST['idpel'];
$status   = $_POST['status'];
$picture_file = $_FILES['picture_file']['name'];

if ($picture_file != "") {
  $allowed = array('png', 'jpg');
  $x = explode('.', $picture_file);
  $extension = strtolower(end($x));
  $file_tmp = $_FILES['picture_file']['tmp_name'];
  $random     = rand(1, 999);
  $filename = $random . '-' . $picture_file;

  if (in_array($extension, $allowed) === true) {
    move_uploaded_file($file_tmp, 'images/' . $filename);

    $query = "INSERT INTO m_pemutusan (UNITUPI, IDPEL, FOTO, KOORDINAT_X, KOORDINAT_Y, STATUS) VALUES ('$unitupi', '$idpel', '$filename', '$lat', '$long', '$status')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      die(mysqli_errno($conn) .
        " - " . mysqli_error($conn));
    } else {
      $qupdate = "UPDATE m_pemutusan_wo SET FLAG='1' WHERE IDPEL=" . $idpel . "";
      $hsil = mysqli_query($conn, $qupdate);

      if (!$result) {
        die(mysqli_errno($conn) .
          " - " . mysqli_error($conn));
      } else {
        echo "gagal update flag";
      }

      echo "success";
    }
  } else {

    echo "invalid extension";
  }
} else {
  $query =
    "INSERT INTO m_pemutusan (UNITUPI, IDPEL, FOTO, KOORDINAT_X, KOORDINAT_Y) VALUES ('$unitupi', '$idpel', null, '$lat', '$long')";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die(mysqli_errno($conn) .
      " - " . mysqli_error($conn));
  } else {
    $qupdate = "UPDATE m_pemutusan_wo SET FLAG='1' WHERE IDPEL=" . $idpel . "";
    $hsil = mysqli_query($conn, $qupdate);

    if (!$result) {
      die(mysqli_errno($conn) .
        " - " . mysqli_error($conn));
    } else {
      echo "gagal update flag";
    }
    echo "success";
  }
}
