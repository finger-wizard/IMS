<?php 
	$purchase_orders = $_POST['payload'];

	var_dump($purchase_orders);
	die;


	include('connection.php');


try {
	foreach($purchase_orders as $po){
		$received = (int) $po['qtyReceived'];
		$status = $po['status'];
		$row_id = $po['Id'];
		$qty_Ordered = (int) $po['qtyOrdered'];


		$qty_remaining = $qty_Ordered - $received;


		$sql = "UPDATE order_product 
					SET 
					quantity_received=?, status=?, quantity_remaining=?
					WHERE id=?";


		$stmt = $conn->prepare($sql);
		$stmt->execute([$received, $status, $qty_remaining, $row_id]);

	}

	$response = [
		'success' => true,
		'message' => "Your Purchase order has been successfully updated!!"
		];
	

} catch (Exception $e) {
		$response = [
		'success' => false,
		'message' => "Error! processng your request"
		];
}

echo json_encode($response);
  
	





	


 ?>