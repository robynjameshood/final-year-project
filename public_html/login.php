<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <?php require_once 'vendor/autoload.php'; ?>
    <meta http-equiv="refresh" content="">
    <link rel="stylesheet" href="styles.css"
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="title">Welcome to Smart-Bets</div>
</div>
<div class="background" id="background-select">
    <div class = "login-form-container" id = "login-form-container">
        <form class = registrationForm action="client-processing.php?option=2" method="post">
            <div id = "login-error"><?php if(isset($_GET['error']) == true) { echo 'Incorrect email/password';}?></div>
            <div id = "registered-error"><?php if(isset($_GET['already-registered']) == true) { echo 'A user with that account is already registered!';}?></div>
            <input type = "text" id = "emailAddressID" placeholder="Email" name = "email" required>
            <input type = "password" id = "passwordField" placeholder="Password" name = "password" required><br>
            <input type = "submit" id = "submitButton" value = "Login">
            <a href="register" div class = "new-user" id = "new-user"><h3><b>Not registered? Click here to register</b></h3></a>
        </form>
    </div>
</div>


</div>
</body>
<script type="text/javascript" src="java.js"></script>
</html>