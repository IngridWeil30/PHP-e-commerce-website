<?php
/**
 * Created by PhpStorm.
 * User: ingridweil
 * Date: 3/19/18
 * Time: 11:38 AM
 */
include_once("connect_db.php");
session_start();
?>
<!DOCTYPE html>
<html>
<?php
//si loggué, redirection vers site
if (isset($_SESSION["name"])) {
    header("Location: index.php?name=".$_SESSION["name"]);
    exit;
}

//user a submit le formulaire
elseif ($_POST["email"] != null && $_POST["password"] != null) {
//validation des credentials :
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn = connect_db("localhost", "root", "takenoko", "3306", "gecko");
    $result = $conn->query("SELECT * FROM users WHERE email='$email'")->fetch(PDO::FETCH_ASSOC);
    $name = $result["name"];
    $login = $result["email"];
    $password = $result["password"];

// enregistrement et redirection si credentials ok...
    if (password_verify($_POST['password'], $password)) {
        $_SESSION["name"] = $name;
        header("Location: index.php?name=".$_SESSION["name"]);
        exit;
    }
}
//...sinon rien (formulaire)
?>
<head>
    <meta charset="utf-8"/>
    <title> Tests - PHP </title>
</head>
<body>
<form action='index.php?name="<?php echo 'jlnjqdnihsd'; ?>"'>
        <?php
        $conn = connect_db("localhost", "root", "takenoko", "3306", "gecko");
        $result = $conn->query("SELECT * FROM users WHERE email='$email'")->fetch(PDO::FETCH_ASSOC);
        $name = $result["name"];
        $login = $result["email"];
        $password = $result["password"];
//on verifie si email et password sont valides
            if (isset($_POST["email"]) && isset($_POST["password"])) {
            if ($login != ($_POST['email']) && password_verify($_POST['password'],$password)) {
                echo "Incorrect email/password";
            }
        }
        ?>
        <p><label> Email : <input type="text" name="email"/></label>
        <p><label> Password : <input type="password" name="password"/></label>
            <input type="submit" value="Submit"/></p>
</form>
</body>
</html>