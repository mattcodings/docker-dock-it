<?php
include 'includes/header.php';

$_SESSION['csrf_token'] = $_SESSION['csrf_token'] ?? md5(uniqid());

require_once "includes/database.php";

$id = $_GET['id'] ?? '1';

$id = intval($id);

// build query
$query = "SELECT * FROM FoodMenu WHERE MenuItemID = '$id'";

// execute query
$result = mysqli_query($db, $query) or die('Error loading table.');

// get one record from the database
$item = mysqli_fetch_array($result, MYSQLI_ASSOC);

$sort = $_GET['sort'] ?? 'Name';
$queryFood = "SELECT Food.FoodID, Food.Name, Food.FoodCategoryID, Food.FoodQuantity
FROM Food
ORDER BY $sort";

$foodResult1 = mysqli_query($db, $queryFood) or die('Error loading food.');
$foodResult2 = mysqli_query($db, $queryFood) or die('Error loading food.');
$foodResult3 = mysqli_query($db, $queryFood) or die('Error loading food.');

$ingredients = $_POST['ingredients'] ?? [];
?>
<link rel="stylesheet" href="css/style.css">
<h1 class="text-center mt-5">Add Menu Item</h1>

<?php
if (isset($_POST['add'])) {
    if ($_POST['csrf_token'] != $_SESSION['csrf_token']) {
        die('Invalid token.');
    }

    $formIsValid = true;
    $menuItemId = $_POST['menuItemId'] ?? '';
    $menuItemName = $_POST['menuItemName'] ?? '';
    $ingredients = implode(', ', $_POST['ingredients']) ?? '';
    $price = $_POST['price'] ?? '';
    $menuName = $_POST['menuName'] ?? '';

    $menuItemName = strip_tags($menuItemName);
    $price = strip_tags($price);
    $menuName = strip_tags($menuName);

    if ($formIsValid) {
        $query = "INSERT INTO `FoodMenu`
(`MenuItemID`, `MenuItemName`, `Ingredients`, `Price`, MenuName)
VALUES
(NULL, ?, ?, ?, ?);";

        $stmt = mysqli_prepare($db, $query) or die('Invalid query');
        mysqli_stmt_bind_param($stmt, 'ssis', $menuItemName, $ingredients, $price, $menuName);
        mysqli_stmt_execute($stmt);
        if (mysqli_insert_id($db)) {
            header('Location: food-items.php?id=' . $menuItemId);
        }
    }
}
mysqli_close($db);
?>
<div class="add-item-form">
    <form method="post">
        <p class="add-menu-item-name">
            <label for="menuItemName">Name: </label>
            <input type="text" id="menuItemName" name="menuItemName">
            <label for="menuItemName" class="error"><?= $nameError ?? '' ?></label>
        </p>
        <div class="menu-item-containers">
            <div class="add-menu-item-fruit-section">
                <h2 class="add-menu-item-container-header">Fruits</h2>
                <div class="add-menu-item-selection">
                    <?php
                    while ($row = mysqli_fetch_array($foodResult1, MYSQLI_ASSOC)) {
                        if ($row['FoodCategoryID'] == 1) {

                            ?>
                            <label class="p-2 add-menu-item-individual-ingredient">
                                <input type="checkbox" class="mb-5 checkbox" name="ingredients[]"
                                       value=<?= $row['Name'] ?>><span class="p-2"><?= $row['Name'] ?></span></label>
                            <?php

                        }
                    }

                    ?>
                </div>
            </div>
            <div class="add-menu-item-vegetables-section">
                <h2 class="add-menu-item-container-header">Vegetables</h2>
                <div class="add-menu-item-selection">
                    <?php


                    while ($row = mysqli_fetch_array($foodResult2, MYSQLI_ASSOC)) {
                        if ($row['FoodCategoryID'] == 2) {

                            ?>
                            <label class="p-2 add-menu-item-individual-ingredient">
                                <input type="checkbox" class="mb-5 checkbox" name="ingredients[]"
                                       value=<?= $row['Name'] ?>><span class="p-2"><?= $row['Name'] ?></span></label>
                            <?php

                        }
                    }

                    ?>
                </div>
            </div>
            <div class="add-menu-item-other-section">
                <h2 class="add-menu-item-container-header">Other</h2>
                <div class="add-menu-item-selection">
                    <?php
                    while ($row = mysqli_fetch_array($foodResult3, MYSQLI_ASSOC)) {
                        if ($row['FoodCategoryID'] == 3) {

                            ?>
                            <label class="p-2 add-menu-item-individual-ingredient">
                                <input type="checkbox" class="mb-5 checkbox" name="ingredients[]"
                                       value=<?= $row['Name'] ?>><span class="p-2"><?= $row['Name'] ?></span></label>
                            <?php

                        }
                    }

                    ?>
                </div>
            </div>
        </div>
        <div class="text-center my-5">
            <h3 class="price-input-label"><label for="price">Price: </label></h3>
            <input type="text" id="price" name="price">
            <label for="price" class="error"><?= $quantityError ?? '' ?></label>
        </div>

        <h3 class="text-center mb-3">Select Menu To Add To </h3>
        <div class="add-menu-item-radio-icon-container mb-5">
            <label class="add-menu-item-radio-icon">
                <input type="radio" name="menuName" value="food" style="display:none">
                <i class="fas fa-hamburger"><span class="add-menu-item-radio-icon-text">Food</span></i>

            </label>
            <label class="add-menu-item-radio-icon">
                <input type="radio" name="menuName" value="juices" style="display:none">
                <i class="fas fa-glass-whiskey"><span class="add-menu-item-radio-icon-text">Drinks</span></i>
            </label>
            <label class="add-menu-item-radio-icon">
                <input type="radio" name="menuName" value="desserts" style="display:none">
                <i class="fas fa-ice-cream"><span class="add-menu-item-radio-icon-text">Desserts</span></i>
            </label>
        </div>

        <p class="edit-line">
            <input type="hidden" name="foodId" value="<?= $item['MenuItemID'] ?>">
        </p>
        <p class="add-menu-item-buttons-container">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <button class="btn btn-add btn-save add-menu-item-button" type="submit" name="add">Add Item</button>
            <a href="inventory.php" class="back-to-food-link">Back to Inventory</a>
        </p>
    </form>
</div>