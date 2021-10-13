<?php

include 'conn.php';
header('Access-Control-Allow-Origin:*');
header('Content-type: application/json');

$wo = $_GET['wo'];

if ($wo) {
  $wo = mysqli_query($conn, 'SELECT * FROM m_pemutusan_wo WHERE KODE_WO = "' . $wo . '"');
  while ($row_wo = mysqli_fetch_assoc($wo)) {
    $data_wo[] = $row_wo;
  }

  if ($data_wo < 1) {
    echo json_encode([]);
  } else {
    echo json_encode($data_wo);
  }
} else {
  // category
  $category = mysqli_query($conn, 'SELECT DISTINCT KDDK FROM m_pemutusan_wo');
  while ($row_cat = mysqli_fetch_assoc($category)) {
    $cat[] = $row_cat;
  }

  function getData($c, $cat)
  {
    $query = mysqli_query($c, 'SELECT * FROM m_pemutusan_wo WHERE FLAG = "0" AND KDDK = "' . $cat . '"');
    while ($row = mysqli_fetch_assoc($query)) {
      $result[] = $row;
    }
    if ($result < 1) {
      return array();
    }
    return $result;
  }

  for ($i = 0; $i < count($cat); $i++) {
    $cat[$i]['DATA'] = getData($conn, $cat[$i]['KDDK']);
  }

  echo json_encode($cat);
}
