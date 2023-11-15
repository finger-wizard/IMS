<?php
    session_start();

    //Remove all sessions Variables
    session_unset();
    
    //DESTROY
    session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logout</title>
    <link rel="stylesheet" type="text/css" href="logout.css">
    <link rel="icon" type="image/x-icon" href="database/favicon.ico">
</head>
<body id="logoutBody">
        <div>
        <p><strong>Ciao, for now. We logged you out successfully.</strong><br>
        </p>
        <a href="/Inventory Management System/login.php"><Button class="logoutBtn">Log back in</Button></a>
        </div>
</body>
</html>