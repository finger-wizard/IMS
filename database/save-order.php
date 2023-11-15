<?php 

session_start();

$post_data = $_POST;
$products = $post_data['products'];
$qty = array_values($post_data['quantity']);

$post_data_arr = [];


foreach ($products as $key => $pId) {
	if(isset($qty[$key])) $post_data_arr[$pId] = $qty[$key];
	
}


//Include connection
include('connection.php');


//Store data...
$batch = time();
$success = false;

try {


	foreach ($post_data_arr as $pId => $supplier_qty) {
	foreach($supplier_qty as $sId => $qty){
		
		//Insert to the database....
		

		$values = [
				'supplier' => $sId,
				'product' => $pId,
				'quantity_ordered' => $qty,
				'status' => 'pending',
				'batch' => $batch,
				'created_by' => $_SESSION['user']['Id'],
				'updated_at' => date('Y-m-d H:i:s'),
				'created_at' => date('Y-m-d H:i:s')
			];


			$sql = "INSERT INTO order_product
			(supplier, product, quantity_ordered, status, batch, created_by, updated_at, created_at)
			VALUES
			(:supplier, :product, :quantity_ordered, :status, :batch, :created_by, :updated_at, :created_at)";

			$stmt = $conn->prepare($sql);
			$stmt->execute($values);
	}
}
	$success = true;
	$message = 'Yayy!! ORDER PLACED SUCCESSFULLY';	
} catch (Exception $e) {
$message = $e->getMessage();
	
}

$_SESSION['response'] = [
	'message' => $message,
	'success' => $success
];

header('location: ../product-order.php');

?>