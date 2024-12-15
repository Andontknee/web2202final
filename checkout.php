<?php session_start(); ?>
<html>
<head>
<title>Checkout</title>
<link href="css/storePage.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="checkout">
<div class="txt-heading">Checkout</div>

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
<th><strong>Price <br>(RM)</strong></th>
</tr>
<?php 
foreach ($_SESSION["cart_item"] as $item) {
 ?>
            <tr>
            <td><strong><?php  echo $item["name"]; ?></strong></td>
            <td><?php  echo $item["code"]; ?></td>
            <td><?php  echo $item["quantity"]; ?></td>
            <td align=right><?php  echo $item["price"]; ?></td>
            <td align=right><?php  echo ($item["price"] * $item["quantity"]); ?></td>
            </tr>
            <?php 
            $item_total += ($item["price"] * $item["quantity"]);
            }
            ?>
   <tr>
   <td colspan="5" align=right><strong>Total: </strong><?php echo "RM ".$item_total;?></td>
   </tr>
</tbody>
</table>
<?php
}
?>

<form action="confirmation.php" method="post">
    <div class="checkout-item">
        <label for="payment-method">Choose a payment method:</label>
        <select name="payment-method" id="payment-method">
            <option value="credit-card">Credit Card</option>
            <option value="debit-card">Debit Card</option>
            <option value="paypal">Online Banking</option>
            <option value="bank-transfer">Touch and Go</option>
        </select>
    </div>
    <div class="checkout-item">
        <input type="submit" value="Submit Payment" class="btnCheckoutAction">
    </div>
</form>
</div>
</body>
</html>
