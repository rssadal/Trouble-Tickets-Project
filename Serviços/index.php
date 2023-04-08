<?php

  $db = new PDO('sqlite:example.db'); 

  $prep = $db->prepare('SELECT username, nome, password2, email, role2 FROM User2');
  $prep->execute(array());
  $rows = $prep->fetchAll();

  echo "<table>";

  $columnNames = array();
  for ($i = 0; $i < $prep->columnCount(); $i++) {
      $meta = $prep->getColumnMeta($i);
      $columnNames[] = $meta['name'];
  }

  echo "<tr>";
  foreach($columnNames as $columnName) {
      echo "<th>".$columnName."</th>";
  }
  echo "</tr>";
  foreach($rows as $row) {
    echo "<tr>";
    echo "<td>".$row['username']."</td>";
    echo "<td>".$row['nome']."</td>";
    echo "<td>".$row['password2']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['role2']."</td>";
    echo "</tr>";
  }
  echo "</table>";

?>
