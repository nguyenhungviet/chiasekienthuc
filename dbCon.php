<?php
$db=new PDO('mysql:host=localhost;dbname=productsql','root','');
$db->exec("set names 'utf8'");
$sql="select * from products";
$result=$db->query($sql);
$mang=$result->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($mang);

?>

