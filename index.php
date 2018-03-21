<?php
include "BDD_Management/Product/get_products.php";
include "BDD_Management/connect_db.php";
include "PHP_Generated/Generate_product.php";
$db = connect_db();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default rounded borders and increase the bottom margin */
        .navbar {
            margin-bottom: 50px;
            border-radius: 0;
        }

        /* Remove the jumbotron's default bottom margin */
        .jumbotron {
            margin-bottom: 0;
        }

        /* Add a gray background color and some padding to the footer */
        footer {
            background-color: #f2f2f2;
            padding: 25px;
        }
    </style>
</head>
<body>



<div class="jumbotron">
    <div class="container text-center">
        <h1>Welcome to Banana World</h1>
        <p>Here you can find all sorts of bananas !</p>
        <img class="minion" src="https://img0.etsystatic.com/100/0/10775770/il_340x270.832626606_imki.jpg" alt="Un minion avec une banane"/>
    </div>
</div>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">

            <ul class="nav navbar-nav navbar-right">
                <li><a href="User/Login_Register/login.php"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
      <?php
        foreach(get_products($db) as $prod){

          $data = [
            'id' => $prod->category_id,
          ];

          $stmt = $db->prepare("SELECT name FROM categories WHERE id = :id");
          $stmt->execute($data);
          $cat = $stmt->fetch(PDO::FETCH_OBJ);
          $form = new product($prod->name,"index.php", $prod->image ,$cat->name,$prod->price);
        }
      ?>


    </div>
</div><br><br>

<footer class="container-fluid text-center">
  <a href="Admin/admin.php"><span style="text-align : center"class="glyphicon glyphicon-user"></span> Admin</a>

</footer>
</body>
</html>
