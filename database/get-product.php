<?php 
include ('connection.php');

$id = $_GET['id'];


$stmt = $conn->prepare("SELECT * FROM products WHERE Id = $id");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);



//Fetch suppliers
$stmt = $conn->prepare("
   SELECT 
   		supplier_name, suppliers.Id
   FROM 
   		suppliers, productsuppliers 
   WHERE 
   		productsuppliers.product = $id
   		AND
   			productsuppliers.supplier = suppliers.Id
   ");
$stmt->execute();
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);


$row['suppliers'] = array_column($suppliers,'Id');

echo json_encode($row);
 ?>
 