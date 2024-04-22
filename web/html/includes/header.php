<?php
session_name('php_final');
session_start();
if (!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}
include "includes/database.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form.add-to-cart').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                console.log(formData);  // Check what is being sent
                $.post('addToCart.php', formData, function(response) {
                    console.log("Response received: " + response);
                    alert("Server says: " + response);
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX error: " + textStatus + ' : ' + errorThrown);
                });
            });
        });
    </script>
</head>
<body>
<nav class="container">
    <img src="../images/juicy-roots-cafe-logo.png" width="264">
    <div class="container">
    <div class="main-nav-item"><a href="index.php">Menu</a></div>
    <div class="main-nav-item"><a href="food-items.php">Create</a></div>
        <div class="main-nav-item"><a href="cart.php">Cart</a></div>
    <div class="main-nav-item"><a href="login.php">Sign In</a></div>

    <?php
    if(isset($_SESSION['foodAuthUser']) and $_SESSION['foodAuthUser']):
        ?>
        <?php if($_SESSION['foodAuthUser']['role'] == 'admin'): ?>
        <div class="main-nav-item"><a href="inventory.php">Inventory</a></div>
    <?php endif; ?>


    <?php endif; ?>
    </div>
</nav>
<header class="hero-image"></header>



