<?php
include 'includes/header.php';

$_SESSION['csrf_token'] = $_SESSION['csrf_token'] ?? md5(uniqid());

require_once "includes/database.php";

$id = $_GET['id'] ?? '1';

$id = intval($id);

// build query
$query = "SELECT * FROM Food WHERE FoodID = '$id'";

// execute query
$result = mysqli_query($db, $query) or die('Error loading table.');

// get one record from the database
$item = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>



<?php
if (isset($_POST['add'])) {
    if ($_POST['csrf_token'] != $_SESSION['csrf_token']) {
        die('Invalid token.');
    }

    $formIsValid = true;
    $foodId = $_POST['foodId'] ?? '';
    $name = $_POST['name'] ?? '';
    $foodCategoryID = $_POST['food-category-id'] ?? '';
    $foodQuantity = $_POST['food-quantity'] ?? '';

    if (empty($name) || strlen($name) < 2) {
        $formIsValid = false;
        $nameError = "Name must be at least 2 characters.";
    }

    $name = strip_tags($name);
    $foodCategoryID = strip_tags($foodCategoryID);
    $foodQuantity = strip_tags($foodQuantity);

    if ($formIsValid) {
        $query = "INSERT INTO `Food`
(`FoodID`, `Name`, `FoodCategoryID`, `FoodQuantity`)
VALUES
(NULL, ?, ?, ?);";

        $stmt = mysqli_prepare($db, $query) or die('Invalid query');
        mysqli_stmt_bind_param($stmt, 'sis', $name, $foodCategoryID, $foodQuantity);
        mysqli_stmt_execute($stmt);
        if (mysqli_insert_id($db)) {
            header('Location: food-items.php?id=' . $foodId);
        }
    }
}
mysqli_close($db);
?>
<h1>Add Item</h1>
<form method="post"
<p class="edit-line">
    <label for="name">Name: </label>
    <input type="text" id="name" name="name">
    <label for="name" class="error"><?= $nameError ?? '' ?></label>
</p>

<p class="edit-line">
    <label for="food-category-id">Type of Food: </label>
    <select type="text" id="food-category-id" name="food-category-id">
        <option value="1" <?= $item['FoodCategoryID'] == 1 ? 'selected' : '' ?>>Fruit</option>
        <option value="2" <?= $item['FoodCategoryID'] == 2 ? 'selected' : '' ?>>Vegetable</option>
        <option value="3" <?= $item['FoodCategoryID'] == 3 ? 'selected' : '' ?>>Other</option>
    </select>
</p>
<p class="edit-line">
    <label for="food-quantity">Quantity: </label>
    <input type="number" id="food-quantity" name="food-quantity">
    <label for="name" class="error"><?= $quantityError ?? '' ?></label>
</p>
<p class="edit-line">
    <input type="hidden" name="foodId" value="<?= $item['FoodID'] ?>">
</p>
<p class="edit-line">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <button class="btn btn-add btn-save" type="submit" name="add">Add Item</button>
    <button class="back-to-food"><p><a href="food-items.php">Back to Food</a></p></button>
</p>