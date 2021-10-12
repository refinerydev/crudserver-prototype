<?php

include 'conn.php';
header('Access-Control-Allow-Origin:*');
header('Content-type: application/json');


// category
$category = mysqli_query($conn, 'SELECT DISTINCT KDDK FROM m_pemutusan_wo');
while ($row_cat = mysqli_fetch_assoc($category)) {
  $cat[] = $row_cat;
}


function getData($c, $cat)
{
  $query = mysqli_query($c, 'SELECT * FROM m_pemutusan_wo WHERE FLAG = "0" AND KDDK = "' . $cat . '"');
  while ($row = mysqli_fetch_assoc($query)) {
    if ($row == null) {
      return 0;
    }
    $result[] = $row;
  }
  return $result;
}

for ($i = 0; $i < count($cat); $i++) {
  $cat[$i]['DATA'] = getData($conn, $cat[$i]['KDDK']);
}

echo json_encode($cat);
