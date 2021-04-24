<?php
// SET HEADER
//header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// INCLUDING DATABASE AND MAKING OBJECT
require 'database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST

$title = $_POST['title'];
$body = $_POST['body'];
$author = $_POST['author'];


//CREATE MESSAGE ARRAY AND SET EMPTY
$msg['message'] = '';

// CHECK IF RECEIVED DATA FROM THE REQUEST
if(isset($title) && isset($body) && isset($author)){
    // CHECK DATA VALUE IS EMPTY OR NOT
    if(!empty($title) && !empty($body) && !empty($author)){
        
        $insert_query = "INSERT INTO `posts`(title,body,author) VALUES(:title,:body,:author)";
        
        $insert_stmt = $conn->prepare($insert_query);
        // DATA BINDING
        $insert_stmt->bindValue(':title', htmlspecialchars(strip_tags($title)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':body', htmlspecialchars(strip_tags($body)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':author', htmlspecialchars(strip_tags($author)),PDO::PARAM_STR);
        
        if($insert_stmt->execute()){
            $msg['message'] = 'Data Inserted Successfully';
        }else{
            $msg['message'] = 'Data not Inserted';
        } 
        
    }else{
        $msg['message'] = 'Oops! empty field detected. Please fill all the fields';
    }
}
else{
    $msg['message'] = 'Please fill all the fields | title, body, author';
}
//ECHO DATA IN JSON FORMAT
echo  json_encode($msg);
?>