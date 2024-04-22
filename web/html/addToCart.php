<?php
session_start();
include "includes/database.php";
// add a custom drink to the cart on submit
if (isset($_POST['choices'])) {
    $choices = $_POST['choices'] ?? [];
    if (!empty($choices)) {
        $name = "Custom Drinks (" . implode(", ", $choices) . ")";
        $price = 7;

        $cartItem = [
            'name' => $name,
            'price' => $price,
            'quantity' => 1
        ];

        $_SESSION['cart'][] = $cartItem;
    }
    else {
        $name = "Custom Drinks";
        $price = 7;

        $cartItem = [
            'name' => $name,
            'price' => $price,
            'quantity' => 1
        ];

        $_SESSION['cart'][] = $cartItem;
    }

}

if (isset($choices)) {
    foreach ($choices as $choice) {
        $query = "UPDATE Food SET FoodQuantity = FoodQuantity - 1 WHERE Name = ?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, 's', $choice);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

include 'includes/database.php';

// add a menu item to the cart
if (isset($_POST['name'], $_POST['price'])) {
    $menuItemName = $_POST['name'];
    $menuItemPrice = $_POST['price'];

    // Query to get ingredients of the menu item
    $query = "SELECT Ingredients FROM FoodMenu WHERE MenuItemName = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, 's', $menuItemName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $ingredients);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $ingredientList = explode(', ', $ingredients);

    foreach ($ingredientList as $ingredient) {
        $updateQuery = "UPDATE Food SET FoodQuantity = FoodQuantity - 1 WHERE Name = ?";
        $updateStmt = mysqli_prepare($db, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, 's', $ingredient);
        mysqli_stmt_execute($updateStmt);
        mysqli_stmt_close($updateStmt);
    }

    $item = [
        'name' => $menuItemName,
        'price' => $menuItemPrice,
        'quantity' => 1
    ];

    $item_exists = false;
    foreach ($_SESSION['cart'] as $index => $cart_item) {
        if ($cart_item['name'] === $item['name']) {
            $_SESSION['cart'][$index]['quantity']++;  // Increment the quantity
            $item_exists = true;
            break;
        }
    }

    if (!$item_exists) {
        $_SESSION['cart'][] = $item;
    }
}

header('Location: cart.php');
exit;
?>
