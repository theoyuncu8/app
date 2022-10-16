<?php 
	
	
	//Constants for database connection
	define('DB_HOST','localhost');
	define('DB_USER','dluxapp_user');
	define('DB_PASS','dluxapp_password1234');
	define('DB_NAME','dluxmobel_app');

	//We will upload files to this folder
	//So one thing don't forget, also create a folder named uploads inside your project folder i.e. MyApi folder
	define('UPLOAD_PATH', 'uploads/');
	
	//connecting to database 
	$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Unable to connect');
	

	//An array to display the response
	$response = array();

	//if the call is an api call 
	if(isset($_GET['apicall'])){
		
		//switching the api call 
		switch($_GET['apicall']){
			
			//if it is an upload call we will upload the image
			case 'uploadpic':
				
				//first confirming that we have the image and tags in the request parameter
				if(isset($_FILES['pic']['name']) && isset($_POST['tags'])){
					
					//uploading file and storing it to database as well 
					try{
						move_uploaded_file($_FILES['pic']['tmp_name'], UPLOAD_PATH . $_FILES['pic']['name']);
						$stmt = $conn->prepare("INSERT INTO products (title,text_description,featured_image,img1_image,img2_image,img3_image,img4_image,img5_image,tag1_tag,tag2_tag,tag3_tag,category) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
						$stmt->bind_param("ss", $_FILES['pic']['name'],$_POST['tags']);
						if($stmt->execute()){
							$response['error'] = false;
							$response['message'] = 'File uploaded successfully';
						}else{
							throw new Exception("Could not upload file");
						}
					}catch(Exception $e){
						$response['error'] = true;
						$response['message'] = 'Could not upload file';
					}
					
				}else{
					$response['error'] = true;
					$response['message'] = "Required params not available";
				}
			
			break;
			
			//in this call we will fetch all the images 
			case 'getpics':
		
				//getting server ip for building image url 
				$server_ip = gethostbyname(gethostname());
				
				//query to get images from database
				$stmt = $conn->prepare("SELECT id,title,text_description,featured_image,img1_image,img2_image,img3_image,img4_image,img5_image,tag1_tag,tag2_tag,tag3_tag,category FROM products");
				$stmt->execute();
				$stmt->bind_result($id,$title,$desc,$featured_image,$img1_image,$img2_image,$img3_image,$img4_image,$img5_image,$tag1_tag,$tag2_tag,$tag3_tag,$category);
				
				$images = array();

				//fetching all the images from database
				//and pushing it to array 
				while($stmt->fetch()){
					$temp = array();
					$temp['id'] = $id; 
					$temp['title'] = $title; 
					$temp['desc'] = $desc; 
				    $temp['featured_image'] ='http://' . $server_ip . '/MyApi/'. UPLOAD_PATH . $featured_image; 
					$temp['img1_image'] = $img1_image; 
					$temp['img2_image'] = $img2_image; 
					$temp['img3_image'] = $img3_image; 
					$temp['img4_image'] = $img4_image;
					$temp['img5_image'] = $img5_image;
					$temp['tag1_tag'] = $tag1_tag;	
					$temp['tag2_tag'] = $tag2_tag;	
					$temp['tag3_tag'] = $tag3_tag;	
					$temp['category'] = $category;	
					
					array_push($images, $temp);
				}
				
				//pushing the array in response 
				$response['error'] = false;
				$response['images'] = $images; 
			break; 
			
			default: 
				$response['error'] = true;
				$response['message'] = 'Invalid api call';
		}
		
	}else{
		header("HTTP/1.0 404 Not Found");
		echo "<h1>404 Not Found</h1>";
		echo "The page that you have requested could not be found.";
		exit();
	}
	
	//displaying the response in json 
	header('Content-Type: application/json');
	echo json_encode($response);
	
