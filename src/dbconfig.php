<?php
$db_name='ToDo';
$password="root";
$user="yassir";
$dsn="mysql:host=localhost:dbname=$db_name";
$conn=0;

try{
    $conn= new PDO($dsn,$user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection Failed";

}







?>