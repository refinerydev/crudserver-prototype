<?php
include 'conn.php';
header('Access-Control-Allow-Origin: *');

$id = $_POST['id'];
$title   = $_POST['title'];
$description     = $_POST['description'];
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

    $query  = "UPDATE notes SET title = '$title', description = '$description', picture_file = '$filename'";
    $query .= "WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
      die(mysqli_errno($conn) .
        " - " . mysqli_error($conn));
    } else {
      echo "success";
    }
  } else {
    //jika file extension tidak jpg dan png maka alert ini yang tampil
    echo "invalid extension";
  }
} else {
  // jalankan query UPDATE berdasarkan ID yang produknya kita edit
  $query  = "UPDATE notes SET title = '$title', description = '$description'";
  $query .= "WHERE id = '$id'";
  $result = mysqli_query($conn, $query);
  // periska query apakah ada error
  if (!$result) {
    die(mysqli_errno($conn) .
      " - " . mysqli_error($conn));
  } else {
    echo "Success";
  }
}
