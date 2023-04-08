<?php

  $db = new SQLite3('example.db');

  $results = $db->query('SELECT * FROM Ticket');

  $data = array();
  while ($row = $results->fetchArray()) {
    $data[] = $row;
  }

  echo json_encode($data);

?>


