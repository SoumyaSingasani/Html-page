<?php
// Connect to MS Access
$msAccessConn = new PDO("odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq="http://localhost:8080/phpmyadmin/index.php?route=/sql&pos=0&db=employee&table=registration");

// Connect to MySQL
$mysqlConn = new PDO("mysql:host=localhost;dbname=employee", "root", "");

// Fetch data from MS Access
$msAccessQuery = $msAccessConn->query("SELECT * FROM eTimeTrackLite1.mdb");
$data = $msAccessQuery->fetchAll(PDO::FETCH_ASSOC);

// Insert or update data into MySQL in parallel
foreach ($data as $row) {
    $mysqlConn->exec("INSERT INTO registration (id,firstName,lastName,gender,email,password,number) VALUES ('{$row['id']}', '{$row['firstName']}','{$row['lastName']}','{$row['gender']}','{$row['email']}','{$row['password']}','{$row['number']}')");
}

// Close connections
$msAccessConn = null;
$mysqlConn = null;
?>