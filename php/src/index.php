<?php
//These are the defined authentication environment in the db service

// The MySQL service named in the docker-compose.yml.
$host = 'db';

// Database use name
$user = 'MYSQL_USER';

//database user password
$pass = 'MYSQL_PASSWORD';

// database name
$mydatabase = 'MYSQL_DATABASE';
// check the mysql connection status

$conn = new mysqli($host, $user, $pass, $mydatabase);

// select query
$sql = 'SELECT * FROM users';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($conn,$_POST['name']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['pass']); 

    $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($result);

    if($count == 1) {
        header("Location: welcome.php", false);
    }else {
        $error = "Your Login Name or Password is invalid";
        echo $error;
    }


}

?>

<html>
<body>

<form action="" method="post">
Username: <input type="text" name="name"><br>
Password: <input type="text" name="pass"><br>
<input type="submit" name="login" value="login">
</form>

</body>
</html>
