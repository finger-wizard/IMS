<?php
//Start the session.
session_start();
if(!isset($_SESSION['user'])) header('location: login.php');

//Get all products
$show_table = 'products';
$products = include ('database/show.php');
$products = json_encode($products);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="author" content="Vipul Ray">
<meta name="description" content="Dashboard of Retactics-The Inventory Management System">
<title>Product Order | Retactics</title>
<?php include('partials/app-header-scripts.php') ?>
</head>


<body>
	<div id="dashboardMainContainer">
		<?php include('partials/app-sidebar.php')?>
		<div class="dashboard_content_container" id="dashboard_content_container">
		<?php include('partials/app-topnav.php') ?>
		<div class="dashboard_content">
		<div class="dashboard_content_main">
		<div class="row">
		<div class="column column-12">
		<h1 class="section_header"><i class="fa fa-plus"></i> Product Order</h1>
		<div>
		<form action="database/save-order.php" method="POST">
		 	<div class="alignRight">
			<button type="button" class="orderBtn orderProductBtn" id="orderProductBtn">Add Product Order</button>
			</div>


			<div id="orderProductLists">
				<p id="noData">Oops!! PRODUCTS NOT SELECTED YET</p>
			</div>

			<div class="alignRight marginTop20">
			<button type="submit" class="orderBtn submitOrderProductBtn">Submit Order</button>
		</div>
		</form>
		</div>
		<?php 
		if(isset($_SESSION['response'])) {
		$response_message = $_SESSION['response']['message'];
		$is_success = $_SESSION['response']['success'];
		?>
		<div class="responseMessage">
		<p class="responseMessage <?= $is_success  ? 'responseMessage_success' : 'responseMessage_error'?>"> 
		<?= $response_message?>
		</p>
		</div>
		<?php unset($_SESSION['response']); } ?>
		</div>
		</div>
		</div>
		</div>
	</div>
</div>
	<?php include('partials/app-scripts.php') ?>



	<script type="">
		var products = <?= $products ?>;
		var counter = 0;
		function script(){

			var vm = this;

		let productOptions = '\
		<div>\
		<label for="product_name">PRODUCT NAME</label>\
		<select name="products[]" class="productNameSelect" id="product_name">\
		<option>Select Product</option>\
		INSERTPRODUCTHERE\
		</select>\
		<button class="appbtn removeOrderBtn">Clear</button>\
		</div>';
	

			this.initialize = function(){
				this.registerEvents();
				this.renderProductOptions();
			},

		this.renderProductOptions = function(){
			let optionHtml = '';
			products.forEach((product) => {

				optionHtml += '<option value="'+ product.Id +'">'+ product.product_name +'</option>';

			})

			productOptions = productOptions.replace('INSERTPRODUCTHERE', optionHtml);
		},


	this.registerEvents = function(){


        document.addEventListener('click', function(e){
        targetElement = e.target; //Target element
        classList = targetElement.classList;



        //Add new product order event
        if (targetElement.id === 'orderProductBtn') {
        	document.getElementById('noData').style.display = 'none';
        	 let orderProductListsContainer = document.getElementById('orderProductLists');
        	 


        	 orderProductLists.innerHTML += '\
        	 <div class="orderProductRow">\
        	 '+ productOptions +'\
				<div class="supplierRows" id="supplierRows_'+ counter +'" data-counter="'+ counter +'"></div>\
			</div>';

			counter++;
}

	//If clear button is clicked....
	if(targetElement.classList.contains('removeOrderBtn')){
       	let orderRow = targetElement
        	      .closest('div.orderProductRow');

        	      //Remove the element...
        	      orderRow.remove();
        	      
	}

});


        document.addEventListener('change', function(e){
        targetElement = e.target; //Target element
        classList = targetElement.classList;



        //Add suppliers row on product option change
        if (classList.contains('productNameSelect')){
        	let pId = targetElement.value;
        	
        	let counterId =targetElement
        		.closest('div.orderProductRow')
        		.querySelector('.supplierRows')
        		.dataset.counter;


        		$.get('database/get-product-supplier.php', {id: pId}, function(suppliers){
        			vm.renderSupplierRows(suppliers, counterId);
        		}, 'json');
        }
});
},

this.renderSupplierRows = function(suppliers, counterId){
	let supplierRows = '';

	suppliers.forEach((supplier) => {
		supplierRows += '\
		<div class="row">\
		<div style="width: 50%;">\
		<p class="supplierName">'+ supplier.supplier_name +'</p>\
		</div>\
		<div style="width: 50%;">\
		<label for="quantity">Quantity: </label>\
		<input type="number" class="appFormInput orderProductQty" id="quantity" placeholder="Enter quantity..." name="quantity['+ counterId +']['+ supplier.Id +']"/>\
		</div>\
		</div>';
	});

	//Append to container....
	let supplierRowContainer = document.getElementById('supplierRows_' + counterId);
	supplierRowContainer.innerHTML = supplierRows;


	}
}

		(new script()).initialize();
	</script>
</body>
</html>