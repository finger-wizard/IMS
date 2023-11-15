<?php 

$product_name = $_POST['product_name'];
$description = $_POST['description'];
$pId = $_POST['pId'];



//Upload  or move the files to our directory
		$target_dir = "../uploads/products/";


		$file_name_value = NULL;
		$file_data = $_FILES['img'];

		if ($file_data['tmp_name'] !== '') {
		$file_name = $file_data['name'];
		$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
		$file_name = 'product-' . time() .'.' . $file_ext;


		
		$check = getimagesize($file_data['tmp_name']);


		//Move the file.
		if ($check) {
			if (move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)) {
				//Save the file_name to the database.
				$file_name_value = $file_name;
			}
		} 

		}


		
//Update the product record
try {
	$sql = "UPDATE products 
SET 
product_name=?, description=?, img=?
WHERE id=?";

include('connection.php');


$stmt = $conn->prepare($sql);
$stmt->execute([$product_name, $description, $file_name_value, $pId]);


//Delete the old values
$sql = "DELETE FROM productsuppliers WHERE product = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$pId]);

	//Loop through the suppliers and add record...
	//Get suppliers
			$suppliers = isset($_POST['suppliers']) ? $_POST['suppliers'] : [];


		foreach ($suppliers as $supplier) {
			$supplier_data = [
				'supplier_Id' => $supplier,
				'product_Id' => $pId,
				'updated_at' => date('Y-m-d H:i:s'),
				'created_at' => date('Y-m-d H:i:s')
			];


$sql = "INSERT INTO productsuppliers
(supplier, product, updated_at, created_at)
VALUES
(:supplier_Id, :product_Id, :updated_at, :created_at)";



$stmt = $conn->prepare($sql);
$stmt->execute($supplier_data);
		}

$response = [
'success' => true,
'message' => "<strong>$product_name</strong> Successfully updated to the system."
];
	
} catch (Exception $e) {
	$response = [
'success' => false,
'message' => "Error! processng your request"
];
}

		


//Update the product record in the database


echo json_encode($response);
 ?>