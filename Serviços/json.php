<?php

  $db = new SQLite3('example.db');

  $results = $db->query('SELECT * FROM User2');

  $data = array();
  while ($row = $results->fetchArray()) {
    $data[] = $row;
  }

  echo json_encode($data);

?>


