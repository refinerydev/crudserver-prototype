<?php

include 'conn.php';
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$cat = $_GET['category'];
// $page = $_GET['page'];



$query = mysqli_query($conn, 'SELECT DISTINCT category FROM notes');
while ($row = mysqli_fetch_assoc($query)) {
  $result[] = $row;
}

if (!$result) {
  die(mysqli_errno($conn));
}

if ($cat) {
  $query = mysqli_query($conn, 'SELECT * FROM notes WHERE category = "' . $cat . '"');
  while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
  }

  if (!$data) {
    die(mysqli_errno($conn));
  }

  echo json_encode($data);
} else {
  echo json_encode($result);
}

// echo json_encode($result);
