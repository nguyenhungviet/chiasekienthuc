<?php
$connect=mysqli_connect("localhost","root","","productsql");
$data=json_decode(file_get_contents("php://input"));
$id=$data->id;
mysqli_set_charset($connect,'utf8');
$sql="DELETE FROM `products` WHERE id=$id";
mysqli_query($connect, $sql);


