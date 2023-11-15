<?php 
include ('connection.php');

$id = $_GET['id'];


$stmt = $conn->prepare("SELECT * FROM suppliers WHERE Id = $id");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);



//Fetch products
$stmt = $conn->prepare("
   SELECT 
   		product_name, products.Id
   FROM 
   		products, productsuppliers 
   WHERE 
   		productsuppliers.supplier = $id
   		AND
   			productsuppliers.product = products.Id
   ");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


$row['products'] = array_column($products,'Id');

echo json_encode($row);
 ?>
 