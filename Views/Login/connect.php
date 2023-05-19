<?php
    $dir = 'sqlite:../../DataBase/ltwdatabase.db';
    $db  = new PDO($dir) or die("cannot open the database");
?>