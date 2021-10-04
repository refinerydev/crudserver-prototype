<?php

include 'conn.php';
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$query = mysqli_query($conn, 'SELECT * FROM notes ORDER BY id ASC');
while ($row = mysqli_fetch_assoc($query)) {
  $result[] = $row;
}

if (!$result) {
  die(mysqli_errno($conn));
}

echo json_encode($result);
