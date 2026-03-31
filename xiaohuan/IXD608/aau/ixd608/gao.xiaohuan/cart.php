<?php include("parts/header.php"); ?>
<?php include("parts/nav.php"); ?>

<div class="container">
  <h2>Your Cart</h2>

  <div class="grid gap">

    <!-- Items -->
    <div class="col-8">
      <?php include("parts/cart-item.php"); ?>
      <?php include("parts/cart-item.php"); ?>
    </div>

    <!-- Summary -->
    <div class="col-4">
      <?php include("parts/order-summary.php"); ?>
    </div>

  </div>

  <a href="checkout.php" class="btn primary">Proceed to Checkout</a>

</div>

<?php include("parts/footer.php"); ?>