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
    <div class = "register-form-container" id = "register-form-container">
    <form class = registrationForm action="client-processing.php?option=1" method="post">
        <input type = "text" id = "username" placeholder="Username" name = "username" required><br>
        <input type = "text" id = "emailAddressID" placeholder="Email" name = "email" required>
        <input type = "password" id = "passwordField" placeholder="Password" name = "password" required><br>
        <input type = "submit" id = "submitButton" value = "Register">
        <a href="login.php" class = "existing-user" id = "existing-user"><h3><b>Already Registered? Click Here</b></h3></a>
    </form>
    </div>
</div>

</div>
</body>
<script type="text/javascript" src="java.js"></script>
</html>