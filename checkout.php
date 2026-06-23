<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
include "products.php";

if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0) {
    header("Location: cart.php");
    exit;
}

$yourEmail = "example_email123@rutgers.edu";
$message = "A client has purchased the following item: \n\n";
$grandTotal = 0;

for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
    $cartProductId = $_SESSION["cart"][$i];

    for ($j = 0; $j < count($products); $j++) {
        if ($products[$j][0] == $cartProductId) {
            $message = $message . $products[$j][1] . " - $" . number_format($products[$j][2], 2) . "\n";
            $grandTotal = $grandTotal + $products[$j][2];
        }
    }
}

$message = $message . "\n Grand Total: $" . number_format($grandTotal, 2);
$subject = "New Shopping Cart Order";
$headers = "From: noreply@shoppingcart.com";
mail($yourEmail, $subject, $message, $headers);
$_SESSION["cart"] = array();
?>

<html>
    <head>
        <title> Order Confirmed </title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1> Thank you for your purchase! </h1>
    <p> Your order has been confirmed. </p>
    <p> A confirmation email has been sent. </p>

    <a href="index.php"> Back to Store </a>

</body>
</html>
