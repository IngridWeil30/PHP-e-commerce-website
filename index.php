<?php
include "BDD_Management/Product/get_products.php";
include "BDD_Management/Product/Search_product.php";
include "BDD_Management/Categories/get_categories.php";
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
    <link rel="stylesheet" href="Style/index.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link rel="stylesheet" href="Style/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        footer {
            background-color: #f2f2f2;
            padding: 25px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-left" style="background-color:white">
              <form class="form-inline" role="form" method="post">
                  <div class="form-group">
                      <label class="filter-col" style="margin-right:0;" for="pref-perpage">Category :</label>
                      <select name ="cat" id="pref-perpage" class="form-control">
                        <option value="All">All</option>
                        <?php
                           foreach (get_categories($db) as $cat) {
                               echo '<option value='.$cat->name.'>'.$cat->name.'</option>';
                           }
                        ?>
                      </select>
                  </div>

                  <div class="form-group">
                      <label class="filter-col" style="margin-right:0;" for="pref-search">Search:</label>
                      <input name ="name" type="text" class="form-control input-sm" id="pref-search">
                  </div>

                  <div class="form-group">
                    <label class="min">Min Price:</label>
                    <input class="minmax" name ="min" type="number">
                  </div>

                  <div class="form-group">
                    <label class="max">Max Price:</label>
                    <input class="minmax" name ="max" type="number">
                  </div>

                  <div class="form-group">
                      <label class="filter-col" style="margin-right:0;" for="pref-orderby">Order by:</label>
                      <select name="order" id="pref-orderby" class="form-control">
                          <option>None</option>
                          <option>Ascending Price</option>
                          <option>Descending Price</option>
                          <option>Ascending Alphabetical</option>
                          <option>Descending Alphabetical</option>
                      </select>

                  </div>

                  <div class="form-group">
                      <button type="submit" class="btn btn-default filter-col">
                          <span class="glyphicon glyphicon-refresh"></span> Refresh
                      </button>
                  </div>

              </form>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php
                if (isset($_SESSION['username'])) {
                    echo'<li><a><span class="glyphicon glyphicon-user"></span>'.$_SESSION['username'].'</a></li>
                  <li><a href="User/Login_Register/login.php">Logout</a></li>';
                } else {
                    echo'<li><a href="User/Login_Register/login.php" ><span class="glyphicon glyphicon-user"></span>  Log in</a></li>';
                }
              ?>

            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
      <?php

      $data = [
      'name' => $_POST['cat'],
      ];

      $stmt = $db->prepare("SELECT id FROM categories WHERE name = :name
      ");
      $stmt->execute($data);
      $element = $stmt->fetchAll(PDO::FETCH_OBJ);
      $catid = $element[0]->id;

      switch ($_POST['order']) {
        case 'Ascending Price':
            $order="ASC";
            $way="price";
          break;

        case 'Descending Price':
            $way="DESC";
            $order="price";
          break;

        case 'Ascending Alphabetical':
              $way="ASC";
              $order="name";
            break;

        case 'Descending Alphabetical':
              $way="DESC";
              $order="name";
            break;

        default:
          $way="ASC";
          $order="name";
          break;
      }

      if ($_POST['name']==NULL){
        $_POST['name']='%';
      }

      if ($_POST['min']==NULL){
        $_POST['min']='0';
      }

      if ($_POST['max']==NULL){
        $_POST['max']='100';
      }

      if(count(search_product($db, $catid, $_POST['name'],$_POST['min'],$_POST['max'],$order,$way))>0){
        foreach (search_product($db,$catid,$_POST['name'],$_POST['min'],$_POST['max'],$order,$way) as $prod) {
            $data = [
            'id' => $prod->category_id,
          ];
            $stmt = $db->prepare("SELECT name FROM categories WHERE id = :id");
            $stmt->execute($data);
            $cat = $stmt->fetch(PDO::FETCH_OBJ);
            $form = new product($prod->name, "index.php", $prod->image, $cat->name, $prod->price);
        }
      }
      else{
        echo "No results found";
      }
      ?>


    </div>
</div><br><br>

<footer class="container-fluid text-center">
  <a href="Admin/admin.php"><span style="text-align : center"class="glyphicon glyphicon-user"></span> Admin</a>

</footer>
</body>
</html>
