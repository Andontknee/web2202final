<?php
session_start();
require_once("dbcontroller1.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
                
                if(!empty($_SESSION["cart_item"])) {
                    if(array_key_exists($productByCode[0]["code"], $_SESSION["cart_item"])) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productByCode[0]["code"] == $k) {
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "update":
            if(!empty($_POST["quantity"]) && $_POST["quantity"] > 0) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k) {
                        $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                    }
                }
            } else if($_POST["quantity"] == 0) {
                if(!empty($_SESSION["cart_item"])) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                        if($_GET["code"] == $k)
                            unset($_SESSION["cart_item"][$k]);
                            if(empty($_SESSION["cart_item"]))
                                unset($_SESSION["cart_item"]);
                    }
                }
            }
            break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                $code = $_GET["code"];
                if(isset($_SESSION["cart_item"][$code])) { // Check if code exists in cart
                    unset($_SESSION["cart_item"][$code]); // Remove the item
                }
                if(empty($_SESSION["cart_item"])) { // If cart is empty, unset the session
                    unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
?>
<html>
<head>
<title>Feedables Shopping Cart</title>
<link href="css/storePage.css" type="text/css" rel="stylesheet" />
</head>
<body>
   <header> <!--this section is the heading section use across all the webpages in this project-->
        <nav class="navbar">
            <div class="nav-links">
                <a href="community.html">Community</a>
                <a href="testimonials.html">Testimonials</a>
                <a href="resources.html">Resources</a>
            </div>
            <div class="logo">
                <a href="home.html">
                    <img src="images\feedables_logo.png" alt="Feedables Logo" >
                </a>
                
            </div>
            <div class="nav-links">
                <a href="aboutUS.html">About Us</a>
                <a href="supportUS.html">Support Us</a>
                <a href="contactUS.html">Contact</a>
            </div>
            <div class="login-button">
                <a href="loginPage.php">Login</a>
            </div>
        </nav>
    </header>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a></div>
<?php
if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>  
<table>
<tbody>
<tr>
<th><strong>Name</strong></th>
<th><strong>Code</strong></th>
<th><strong>Quantity</strong></th>
<th><strong>Unit Price <br>(RM)</strong></th>
<th><strong>Action</strong></th>
</tr>
<?php 
foreach ($_SESSION["cart_item"] as $item) {
 ?>
            <tr>
            <td><strong><?php  echo $item["name"]; ?></strong></td>
            <td><?php  echo $item["code"]; ?></td>
            <td>
                <form method="post" action="index.php?action=update&code=<?php  echo $item["code"]; ?>">
                    <input type="number" name="quantity" value="<?php echo $item["quantity"]; ?>" size="2" />
                    <input type="submit" value="Update" />
                </form>
            </td>
            <td align=right><?php  echo $item["price"]; ?></td>
            <td><a href="index.php?action=remove&code=<?php  echo $item["code"]; ?>" class="btnRemoveAction">Remove Item</a></td>
            </tr>
            <?php 
            $item_total += ($item["price"] * $item["quantity"]);
            }
            ?>
   <tr>
   <td colspan="5" align=right><strong>Total: </strong><?php echo "RM ".$item_total;?></td>
   </tr>
   <tr>
   <td colspan="5" align=right><a href="checkout.php" class="btnCheckout">Checkout</a></td>
   </tr>
</tbody>
</table>
<?php
}
?>
</div>


<div class="txt-heading">Products</div>
<div id="product-grid">
    <?php
    $product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY id ASC");
    if(!empty($product_array)) { 
        foreach($product_array as $key => $value) {
    ?>
        <div class="product-item">
            <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
            <div class="product-image"><img class="product-image-size" src="<?php echo $product_array[$key]["image"]; ?>"></div>
            <div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
            <div class="product-price"><?php echo "RM ".$product_array[$key]["price"]; ?></div>
            <div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" class="btnAddAction" /></div>
            </form>
        </div>
    <?php
            }
    }
    ?>
</div>
</body>
</html>
