<?php 

/*
	define('DB_HOST', 'localhost');
	define('DB_USER', 'dluxapp_user');
	define('DB_PASS', 'dluxapp_password1234');
	define('DB_NAME', 'dluxmobel_app');
	
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	if (mysqli_connect_errno()) {
		echo "MySQL Error: " . mysqli_connect_error();
		die();
	}
	
	$stmt = $conn->prepare("SELECT id, title, text_description, featured_image, img1_image, img2_image, img3_image, img4_image, img5_image, tag1_tag, tag2_tag, tag3_tag, category, price FROM products;");
	
	$stmt->execute();
	
	$stmt->bind_result($id, $title, $text_description, $featured_image, $img1_image, $img2_image, $img3_image, $img4_image, $img5_image, $tag1_tag, $tag2_tag, $tag3_tag, $category, $price);
	
	$products = array(); 

	while($stmt->fetch()){
		$temp = array();
		$temp['id'] = $id; 
		$temp['title'] = $title; 
		$temp['text_description'] = $text_description; 
		$temp['featured_image'] = $featured_image; 
		$temp['img1_image'] = $img1_image;
		$temp['img2_image'] = $img2_image; 
		$temp['img3_image'] = $img3_image; 
		$temp['img4_image'] = $img4_image; 
		$temp['img5_image'] = $img5_image;
		$temp['tag1_tag'] = $tag1_tag;
		$temp['tag2_tag'] = $tag2_tag;
		$temp['tag3_tag'] = $tag3_tag;
		$temp['category'] = $category;
		$temp['price'] = $price;
		array_push($products, $temp);
	}
	
	echo json_encode($products, JSON_UNESCAPED_UNICODE);
	
	*/
	
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

$result = $dbh->query("SELECT * FROM categories");
$rows = $result->fetchAll();
echo json_encode($rows);


?>