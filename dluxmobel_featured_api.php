<?php 
	
$host    = 'localhost';
$db      = 'dluxmobel_app';
$user    = 'dluxapp_user';
$pass    = 'dluxapp_password1234';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$dbh = new PDO($dsn, $user, $pass, $opt);

$result = $dbh->query("SELECT * FROM featured");
$rows = $result->fetchAll();
echo json_encode($rows);


?>