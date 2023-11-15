<?php 
include ('connection.php');

$id = $_GET['id'];


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


echo json_encode($suppliers);
 ?>
 