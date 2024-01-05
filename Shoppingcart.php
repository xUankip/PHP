<?php
session_start();
$product = array(
    array("id" => 1, "name" => "Aso polo", "price" => 25),
    array("id" => 2, "name" => "Jeans", "price" => 50),
    array("id" => 3, "name" => "Sneaker", "price" => 40),
);
//Kiểm tra nêys giỏ hàng chưa được tạo thì tạo mới
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
//    Hàm thêm sản phâm vào giỏ hàng
    function addToCart($productID)
    {
        global $product;
        foreach ($product as $pd){
            if ($pd['id'] == $productID){
                $_SESSION['cart'][]= $pd;
                echo "ADDED " . $pd ['name'] . " to cart";
                echo "<br>";
                return;
            }
        }
        echo "Item not exist";
    }
//    hàm hiển thị
function viewcart()
{
    if (empty($_SESSION['cart'])){
        echo "EMpTY CART";
    }else{
        echo "<h3>Your product<h3/>";
        $totalPrice =0;
        foreach ($_SESSION['cart'] as $item){
            echo $item['name']. "-$ ". $item['price']."<br>";
            $totalPrice += $item['price'];
        }
        echo "<strong>TOTAL : $ ". $totalPrice ."<strong/>";
    }
}
?>
<!DOCTYPE html>
<html lang=" en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{
            padding: 20px;
        }
        h1,h3{
            color: #36a6ff;
        }
        form{
            margin-bottom: 20px;
        }
        button{
            margin-top: 10px;
        }
        p{
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Trang SHOPPING</h1>
        <form method="post">
            <div class="form-group mr-2">
                <label for="productID">Pick:</label>
            <select name="productID" id="productID" class="form-control">
                <?php foreach ($product as $pd): ?>

                    <option value="<?php echo $pd['id']; ?>"><?php echo $pd['name'] ;?>  - $ <?php echo $pd['price']; ?></option>

                <?php endforeach; ?>
            </select>
            </div>
            <button type="submit" name="addToCart" class="btn btn-primary"> ADD TO CART</button>

        </form>
<!--        Hiển thị giỏ hàng-->
        <?php
        if (isset($_POST['addToCart']) && isset($_POST['productID'])){
            addToCart($_POST['productID']);
        }
        viewcart();
        ?>
</div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>