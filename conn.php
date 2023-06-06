<?php
$servername= "localhost";
$username = "root";
$password = "";
$conn = mysqli_connect($servername, $username, $password);
if(!$conn){
    die("Error Connection:".mysqli_connect_error()); }
$sql = "CREATE DATABASE if not exists exp_db";
if($conn->query($sql)==TRUE){
    //  echo "Database is created successfully!<br>";
}else{
    die("Connection failed:". mysqli_connect_error());
}
$db_name = "exp_db";
$db_conn = mysqli_connect($servername,$username,$password,$db_name);
$table = "CREATE TABLE exp(
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            items VARCHAR(50) NOT NULL,
            expenses VARCHAR(50) NOT NULL,
            time_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP )";
    if(mysqli_query($db_conn,$table)){
        echo "table is created";
    }else{
        // die("Error To Create:".mysqli_error($db_conn)); 
    }
?>