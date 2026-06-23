<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
include "products.php";

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

if (isset($_POST["add"])) {
    $productId = $_POST["product_id"];

    for ($i = 0; $i < count($products); $i++) {
        if ($products[$i][0] == $productId && $products[$i][3] == true) {
            $_SESSION["cart"][] = $productId;
        }
    }

    header("Location: index.php");
    exit;
}
?>

<html>
    <head>
        <title> Shopping Cart </title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1> Product List </h1>
    <a href="cart.php"> View Cart</a>
    <table>
        <tr>
            <th> Product </th>
            <th> Price </th>
            <th> Availability </th>
            <th> Action </th>
</tr>

<?php
for ($i = 0; $i < count($products); $i++) {
    echo "<tr>";
    echo"<td>" . $products[$i][1] . "</td>";
    echo "<td>$" . number_format($products[$i][2], 2) . "</td>";

    if($products[$i][3] == True) {
        echo "<td> Available </td>";
        echo "<td>";
        echo "<form method='post'>";
        echo "<input type= 'hidden' name='product_id' value='" . $products[$i][0] . "'>";
        echo "<button type='submit' name='add'> Add to Cart </button>";
        echo "</form>";
        echo "</td>";
    } else {
        echo "<td> Out of Stock </td>";
        echo "<td> Not available </td>";
    }
    echo "</tr>";
}
?>
</table>
</body>
</html>
