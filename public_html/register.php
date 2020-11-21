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
        <div id = "invalid-email-error"><?php if(isset($_GET['invalid-email']) == true) { echo 'Please enter a valid email address!';}?></div>
        <input type = "text" id = "firstNameID" placeholder="Name" name = "first_name" required><br>
        <input type = "text" id = "secondNameID" placeholder="Surname" name = "second_name" required><br>
        <input type = "text" id = "emailAddressID" placeholder="Email" name = "email" required>
        <input type = "text" id = "userNameID" placeholder="Username" name = "username" required>
        <input type = "password" id = "passwordField" placeholder="Password" name = "password" required><br>
        <input type = "submit" id = "submitButton" value = "Register">
        <a href="login" class = "existing-user" id = "existing-user"><h3><b>Already Registered? Click Here</b></h3></a>
    </form>
    </div>
</div>

</div>
</body>
<script type="text/javascript" src="java.js"></script>
</html>