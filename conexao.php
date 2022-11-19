<?php
 define('DBHOST', 'localhost');
 define('DBUSER', 'root');
 define('DBPASS', 'xxxx');
 define('DBNAME', 'xxxx');
 

 $conn = mysqli_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysqli_select_db($conn,DBNAME);
 
 if ( !$conn ) {
  die("Connection with server failed: " . mysql_error());
 }
 if ( !$dbcon ) {
  die("Connection with database failed: " . mysql_error());
 }
