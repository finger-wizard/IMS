<?php
//Start the session.
session_start();
if(isset($_SESSION['user'])) header('location: dashboard.php');
$error_message = '';

if($_POST){
	include('database/connection.php');

	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = 'SELECT * FROM users WHERE users.email="'. $username .'"AND users.password="'. $password .'"';
	$stmt = $conn->prepare($query);
	$stmt->execute();
	
	if($stmt->rowCount() > 0){
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$user = $stmt->fetchAll()[0];

	//Captures data of currently login users.
	$_SESSION['user'] = $user;

	header ('Location: dashboard.php');
	} else $error_message = 'Please! MAKE SURE THAT USERNAME AND PASSWORD ARE CORRECT';
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="Vipul Ray">
	<meta name="description" content="Login Page for Retactics-The Inventory Management System">
	<title>Login | Retactics</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="icon" type="image/x-icon" href="img/favicon.ico.jpg">
</head>
<body id="loginBody">
	<?php if (!empty ($error_message)) { ?>
	<div id="errorMessage">
		<strong>ERROR:</strong></p><?= $error_message ?></p>
	</div>
	<?php } ?>
	<div class="container">
	  <div class="loginHeader">
	  	<h1 class="article-subtitle">Retactics</h1>
	  	<h3>THE INVENTORY MANAGEMENT SYSTEM</h3>
	  </div>
	  <div class="loginBody">
	  	<form action="login.php" method="POST">
	  		<div class="loginInputsContainer">
			  <div>
			  <i class="fa fa-list"></i>
			  </div>
	  			<label for="">Username</label>
	  			<input type="text" name="username" placeholder="username or email">
	  		</div>
	  		<div class="loginInputsContainer">
	  			<label for="">Password</label>
	  			<input type="password" name="password" placeholder="password">
	  		</div>
	  		<div class="loginButtonContainer">
	  			<button>Login</button>
				  <div class="rememberMe"><input type="checkbox">Remember Me</div>
				  <div><a href="forgotPassword/ForgotPassword.php" style="color:teal; font-weight:bold;">Forgot Password?</a></div>
	  		</div>
			  
	  	</form>
	  </div>	
	</div>
</body>
</html>