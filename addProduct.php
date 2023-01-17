<?php

$pdo = new PDO('mysql:host=localhost;port=3306; dbname=test', 'root', "");

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER['REQUEST_METHOD'] === "POST") {

  $sku = $_POST['sku'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $type = $_POST['type'];
  
  if ($type === 'furniture') {
      $description = $_POST['height']."x".$_POST['length']."x".$_POST['width'];
    } else {
    $description = $_POST['weight'] ?? $_POST['size'];
}

// var_dump($description);

  // easy way
  // $pdo->exec("INSERT INTO products (title, image, description, price, create_date) 
  // VALUES ('$title', '', '$describtion', '$price', '". date('Y-m-d H:i:s')."')");
  
  
  // better way
  $statement = $pdo->prepare("INSERT INTO product (sku, name, price, type, description) 
  VALUES (:sku, :name, :price, :type, :description)");
  
  $statement->bindValue(':sku', $sku);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':price', $price);
  $statement->bindValue(':type', $type);
  $statement->bindValue(':description', $description);
  
  $statement->execute();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="main.css">
    <title>Add Product</title>
</head>
<body>
    <header class='navigation'>
            <h1>Add product</h1>
    </header>
    <form class='product_form box-border container' id='product_form' method="post">
        <div class='btns-wrapper'>
            <button id='delete-product-btn' class='btn'>Save</button>
            <a href='index.php' class='btn'>Cancel</a>
        </div>
        <div class='item-container'>
            <label htmlFor='sku'>SKU</label>
            <input type='text' name="sku" id='sku' required/><br />
        </div>
            <div class='item-container'>
            <label htmlFor='name'>Name</label>
        <input type='text' name="name" id='name' required/><br />
        </div>
        <div class='item-container'>
            <label htmlFor='price'>Price ($)</label>
            <input type='text' name="price" id='price' required/>
        </div>
        <div class='item-container'>
            <label htmlFor='type'>Type Switcher</label>
            <select name="type" id="productType">
                <option value="null" selected>Type Switcher</option>
                <option value='DVD'>DVD</option>
                <option value='book'>Book</option>
                <option value='furniture'>Furniture</option>
            </select>
        </div>
        <div class='description'>
            <!-- js into html -->
        </div>
    </form>
</body>

     <script src="index.js"></script> 
</html>