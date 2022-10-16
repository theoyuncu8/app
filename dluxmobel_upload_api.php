<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $desc = $_POST['text_description'];
    $featuredimg = $_POST['featured_image'];
    $img1 = $_POST['img1_image'];
    $img2 = $_POST['img2_image'];
    $img3 = $_POST['img3_image'];
    $img4 = $_POST['img4_image'];
    $img5 = $_POST['img5_image'];
    $tag1 = $_POST['tag1_tag'];
    $tag2 = $_POST['tag2_tag'];
    $tag3 = $_POST['tag3_tag'];
    $category = $_POST['category'];
    $timemilis = $_POST['timemilis'];
    $getlazyimage = $_POST['lazyimage']; 
    
    
    define('HOST', 'localhost');
    define('USER', 'dluxapp_user');
    define('PASS', 'dluxapp_password1234');
    define('DB', 'dluxmobel_app');

    $con = mysqli_connect(HOST, USER, PASS, DB) or die('Unable to Connect');

    $sql = "SELECT id FROM products ORDER BY id ASC";

    $res = mysqli_query($con, $sql);

    $id = 0;

    while ($row = mysqli_fetch_array($res)) {
        $id = $row['id'];
    }
    
    
   //  $mkdir("$title",9777, false);
     
     
    $path = "uploads/$title"._."$timemilis.jpg"; 
    $lazypath = "uploads/$title"._."$timemilis"._."lazy.jpg"; 


    $actualpath = "http://app.dluxmobilya.com/$path";
    $actuallazypath = "http://app.dluxmobilya.com/$lazypath";
   
   
    $sql = "INSERT INTO products (title,text_description,featured_image,img1_image,img2_image,img3_image,img4_image,img5_image,tag1_tag,tag2_tag,tag3_tag,category,lazyimage) VALUES ('$title','$desc','$actualpath','$img1','$img2','$img3','$img4','$img5','$tag1','$tag2','$tag3','$category','$actuallazypath')";

    if (mysqli_query($con, $sql)) {
        file_put_contents($path, base64_decode($featuredimg));
        file_put_contents($lazypath, base64_decode($getlazyimage));
        echo "Successfully Uploaded";
    }

    mysqli_close($con);
} else {
    echo "Error";
}


/*
$host    = 'localhost';
$db      = 'dluxmobel_app';
$user    = 'dluxapp_user';
$pass    = 'dluxapp_password1234';
$charset = 'utf8';


$conn = new mysqli($host, $user, $pass, $db);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $DefaultId = 0;
    $title = $_POST['title'];
    $desc = $_POST['text_description'];
    $featuredimg = $_POST['featured_image'];
    $img1 = $_POST['img1_image'];
    $img2 = $_POST['img2_image'];
    $img3 = $_POST['img3_image'];
    $img4 = $_POST['img4_image'];
    $img5 = $_POST['img5_image'];
    $tag1 = $_POST['tag1_tag'];
    $tag2 = $_POST['tag2_tag'];
    $tag3 = $_POST['tag3_tag'];
    $category = $_POST['category'];

    $GetOldIdSQL = "SELECT id FROM products ORDER BY id ASC";
    $Query = mysqli_query($conn, $GetOldIdSQL);
    while ($row = mysqli_fetch_array($Query)) {
        $DefaultId = $row['id'];
    }

    $ImagePath = "images/$DefaultId.jpg";
    $ServerURL = "http://app.dluxmobilya.com/uploads/$ImagePath";
    $InsertSQL = "insert into products (title,text_description,featured_image,img1_image,img2_image,img3_image,img4_image,img5_image,tag1_tag,tag2_tag,tag3_tag,category) values ('$title','$desc',' $ServerURL','$img1 ','$img2 ','$img3','$img4','$img5','$tag1',' $tag2',' $tag3','$category','$ImageName')";

    if (mysqli_query($conn, $InsertSQL)) {
        file_put_contents($ImagePath, base64_decode($ImageData));
        echo "Your Image Has Been Uploaded.";
    }

    mysqli_close($conn);
} else {
    echo "Not Uploaded";
}


*/