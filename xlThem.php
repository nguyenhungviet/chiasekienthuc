<?php
$connect=mysqli_connect("localhost","root","","productsql");
$data=json_decode(file_get_contents("php://input"));
$name=$data->name;
$price=$data->price;
$description=$data->description;
$created=0;
$modified=date();
$id=$data->id;
$btnname=$data->btnname;
if($btnname=="Save")
{
    mysqli_set_charset($connect,'utf8');
    $sql="INSERT INTO `products`(`name`, `description`, `price`, `created`, `modified`) VALUES ('$name','$description','$price','$created','$modified')";
    mysqli_query($connect, $sql);
}
if($btnname=="Update")
{
    mysqli_set_charset($connect,'utf8');
    $sql="UPDATE `products` SET `name`='$name',`description`='$description',`price`='$price',`created`='$created',`modified`='$modified' WHERE id='$id'";
    mysqli_query($connect, $sql);
}

