<?php
require_once "includes/database.php";
include 'includes/header.php';

$foodid = $_GET['foodid'] ?? '1';

$foodid = intval($foodid);

$query = "SELECT * FROM Food WHERE FoodID = '$foodid'";
$result = mysqli_query($db, $query) or die('Error in query');
$food = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>
<title><?=$food['Name']?> - The FOOD Database</title>

<a href="inventory.php" class="back-to-food-link mt-5">Back to Inventory</a>
<br>
<br>
<br>
<?php

$query = "SELECT FoodID, Food.Name, FoodCategory.Category, Food.FoodQuantity
FROM Food
LEFT JOIN FoodCategory ON Food.FoodCategoryID = FoodCategory.FoodCategoryID
WHERE FoodID = '$foodid'
ORDER BY Name";

$result = mysqli_query($db, $query) or die("Error loading products.");

if(mysqli_num_rows($result)):
?>
<table>
    <thead>
    <tr>
        <th class="item-th">Name</th>
        <th class="item-th">Category</th>
        <th class="item-th">Quantity</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        echo"<tr>
<td class='item-td'>{$row['Name']}</td>
<td class='item-td'>{$row['Category']}</td>
<td class='item-td'>{$row['FoodQuantity']}</td>
<div class='edit-delete-container'>
<a href='edit-item.php?id={$row['FoodID']}' class='edit-delete-item-button'>Edit</a>
<a href='delete-item.php?id={$row['FoodID']}' class='edit-delete-item-button'>Delete</a>
</div>
</tr>
";
    }
    ?>
    </tbody>
</table>
<?php else: ?>
    <p>Item Updated.</p>
<?php
endif;
mysqli_close($db);
?>

