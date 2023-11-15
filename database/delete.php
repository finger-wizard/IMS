<?php 
$data = $_POST; 

$id = (int) $data ['Id'];
$table = $data['table'];


// Deleting the record.
try {
include('connection.php');

//Delete junction table --->productsuppliers
if ($table === 'suppliers') {
	$supplier_id = $id;
	$command = "DELETE FROM productsuppliers WHERE supplier={$id}";
	$conn->exec($command);	
}
	if ($table === 'products') {
	$supplier_id = $id;
	$command = "DELETE FROM productsuppliers WHERE product={$id}";
	$conn->exec($command);	
}



//Delete main table
$command = "DELETE FROM $table WHERE Id={$id}";
$conn->exec($command);

echo json_encode([
'success' => true,
]);


} catch (PDOException $e) {
echo json_encode([
'success' => false,
]);
}
?>