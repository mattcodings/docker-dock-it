<?php
session_start();
include 'includes/header.php';
?>

<?php
function calculateTotal($cartProducts){
    $total = 0;
    foreach($cartProducts as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
$cartTotal = calculateTotal($_SESSION['cart'])
?>
<?php if (!empty($_SESSION['cart'])): ?>
<div class="cart-container-with-header">
    <h1 class="text-center">Your Cart</h1>
<div class="cart-container">

<div>

    <ul class="cart-list">
        <?php foreach ($_SESSION['cart'] as $item): ?>

            <li class="cart-item mb-5">
                <h3><?php echo $item['name']; ?></h3>
                <h5>$<?php echo $item['price']; ?></h5>
                Quantity: <?php echo $item['quantity']; ?>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

</div>
    <div class="purchase-total">
    <h2 class="text-center"><?php echo "You're total is $" . number_format($cartTotal, 2) ?></h2>
    <form>
        <button class="purchase-btn">Purchase</button>
    </form>
    </div>
</div>
    <?php else: ?>
    <p>Your cart is empty!</p>
<?php endif; ?>

</html>