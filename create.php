<?php
include 'conn.php';
header('Access-Control-Allow-Origin: *');

$title   = $_POST[''];
$description     = $_POST['description'];
$picture_file = $_FILES['FOTO']['name'];

if ($picture_file != "") {
  $allowed = array('png', 'jpg');
  $x = explode('.', $picture_file);
  $extension = strtolower(end($x));
  $file_tmp = $_FILES['FOTO']['tmp_name'];
  $random     = rand(1, 999);
  $filename = $random . '-' . $picture_file;

  if (in_array($extension, $allowed) === true) {
    move_uploaded_file($file_tmp, 'images/' . $filename);

    $query = "INSERT INTO m_pemutusan (FOTO) VALUES ('$filename')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
      die(mysqli_errno($conn) .
        " - " . mysqli_error($conn));
    } else {

      echo "success";
    }
  } else {

    echo "invalid extension";
  }
} else {
  $query = "INSERT INTO m_pemutusan (FOTO) VALUES (null)";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die(mysqli_errno($conn) .
      " - " . mysqli_error($conn));
  } else {

    echo "success";
  }
}
