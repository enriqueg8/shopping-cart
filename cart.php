<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
include "products.php";
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

if (isset($_GET["remove"])) {
    $removeIndex = $_GET["remove"];
    unset($_SESSION["cart"][$removeIndex]);
    $_SESSION["cart"] = array_values($_SESSION["cart"]);

    header("Location: cart.php");
    exit;
}

?>

<html>
    <head>
        <title> Your Cart </title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1> Your Shopping Cart </h1>
    <a href="index.php"> Continue Shopping </a>
    
    <?php
    if (count($_SESSION["cart"]) ==0) {
        echo "<p> Your cart is empty. </p>";
    } else {
        echo "<table>";
        echo "<tr>";
        echo "<th> Product </th>";
        echo "<th> Price </th>";
        echo "<th> Action </th>";
        echo "</tr>";

        $grandTotal = 0;

        for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
            $cartProductID = $_SESSION["cart"][$i];

            for ($j =0; $j < count($products); $j++) {
                if ($products[$j][0] == $cartProductID) {
                    echo "<tr>";
                    echo "<td>" . $products[$j][1] . "</td>";
                    echo "<td>$" . number_format($products[$j][2], 2) . "</td>";
                    echo "<td><a href='cart.php?remove=" . $i . "'>Remove</a></td>";
                    echo "</tr>";

                    $grandTotal = $grandTotal + $products[$j][2];
                }
            }
        }

        echo "<tr>";
        echo "<td><strong>Total</strong></td>";
        echo "<td><strong>$" . number_format($grandTotal, 2) . "</strong></td>";
        echo "<td></td>";
        echo "</tr>";
        echo "</table>";
        echo "<br>";
        echo "<a class= 'checkout' href='checkout.php'> Buy Now </a>";
    }

    ?>
    </body>
    </html>
