

<?php 

$pdo = new PDO('mysql:host=localhost;port=3306; dbname=test', 'root', "");

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$statement = $pdo->prepare('SELECT * FROM product');
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

$productTypes = array(
    'DVD' => array(
        "type" => 'DVD',
        'description' => ["size"],
        'measure' => 'MB',
        'specialAttr' => 'size'
    ),
    'book' => array(
        "type" => 'book',
        'description' => ["weight"],
        'measure' => 'KG',
        'specialAttr' => 'weight'
    ),
    'furniture' => array(
        "type" => 'furniture',
        'description' => ["height", "length", "width"],
        'measure' => 'CM',
        'specialAttr' => 'dimmension'
    )
);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <link rel="stylesheet" href="main.css">
    <title>Product List</title>
</head>
<body>
    <header class='navigation'>
        <h1>Product List</h1>
    </header>
    <form action="delete.php" method="POST">
        <div class='btns-wrapper'>
            <a href='addProduct.php' class='btn'>ADD</a>
            <button type="submit" id='delete-product-btn' class='btn' name="delete-multiple-products">MASS DELETE</button>
        </div>
        <ul class='box-border container'>
            <?php foreach ($products as $i => $product) { ?>
                <?php
                    
                $measure = $productTypes[$product['type']]['measure'];
                $specialAttr = $productTypes[$product['type']]['specialAttr'];
                ?>
                <li>
                    <input name="deleteId[]" type="checkbox" class='delete-checkbox' value='<?php echo $product['id'] ?>'/>
                    <h3><?php echo $product["sku"] ?></h3>
                    <p><?php echo $product["name"] ?></p>
                    <p><?php echo $product["price"] ?>$</p>
                    <p><?php echo $specialAttr. ": " . $product["description"] . $measure ?></p>
                </li>
            <?php } ?>
        </ul>
    </form>
</body>
</html>
            