<?php
require_once "includes/database.php";
$sort = $_GET['sort'] ?? 'Name';
$queryMenu = "SELECT FoodMenu.MenuItemName, FoodMenu.Ingredients, FoodMenu.Price
FROM FoodMenu";
$query = "SELECT Food.FoodID, Food.Name, Food.FoodCategoryID, Food.FoodQuantity
FROM Food
ORDER BY $sort";
$result = mysqli_query($db, $query) or die('Error loading food.');
$choices = $_POST['choices'] ?? [];
include 'includes/header.php';
$formIsValid = true;
foreach ($choices as $food) {
    $query = "UPDATE Food SET FoodQuantity = FoodQuantity - 1 WHERE Name = '$food'";
    $stmt = mysqli_prepare($db, $query) or die('Invalid query');
    mysqli_stmt_execute($stmt);
    echo implode(' ', $choices);
}
?>
    <section class="build-your-own-container">
        <form method="post" class="add-to-cart" action="addToCart.php">

            <h2>Build Your Own Drink</h2>
            <section class="build-your-own">
                <?php
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if ($row['FoodCategoryID'] == 1 && $row['FoodQuantity'] > 0 || $row['FoodCategoryID'] == 2 && $row['FoodQuantity'] > 0) {

                        ?>
                        <label class="add-menu-item-individual-ingredient"><input type="checkbox" name="choices[]" class="mb-5"
                                                                  value=<?= $row['Name'] ?>><?= $row['Name'] ?></label>

                        <?php
                    } else {
                        ?>
                        <span class="add-menu-item-individual-ingredient out-of-stock-text mb-5"><?= $row['Name'] ?> (out of stock)</span>
                        <?php
                    }
                }
                ?>
            </section>
            <div class="text-center">
                <button type="submit">Add To Cart</button>
            </div>

        </form>
    </section>
    <pre>
<?php echo "hello" . var_dump($choices); ?>
</pre>
<?php

